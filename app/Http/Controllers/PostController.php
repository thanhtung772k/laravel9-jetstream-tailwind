<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Services\Category\CategoryService;
use App\Services\Post\PostService;
use App\Services\User\UserService;
use App\Services\UserDetail\UserDetailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\ManageFile;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use ManageFile;

    public function __construct()
    {
        $this->postService = app(PostService::class);
        $this->categoryService = app(CategoryService::class);
        $this->userService = app(UserService::class);
        $this->userDetailService = app(UserDetailService::class);
    }

    /**
     * show all list post
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $posts = $this->postService->index($request);
        $categories = $this->categoryService->getAll();
        return view('home.post.dashbroad', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

    /**
     * Create new a post
     *
     * @return void
     */
    public function create()
    {
        $categories = $this->categoryService->getAll();
        $author = $this->userDetailService->detail(Auth::id());
        return view('home.post.create', [
            'categories' => $categories,
            'author' => $author
        ]);
    }

    /**
     * insert a new post
     *
     * @param Request $request
     * @return void
     */
    public function insert(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->postService->insert($request);
            $this->userDetailService->updateInfo($request->author);
            DB::commit();
            return redirect()->route('index_post');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors();
        }
    }

    /**
     * find post by slug
     *
     * @param $id
     * @return int
     */
    public function edit($id)
    {
        $categories = $this->categoryService->getAll();
        $post = $this->postService->findBySlug($id);
        $author = $this->userDetailService->detail(Auth::id());
        return view('home.post.edit', [
            'categories' => $categories,
            'post' => $post,
            'author' => $author
        ]);
    }

    /**
     * Update post by id
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->postService->update($request, $id);
            $this->userDetailService->updateInfo($request->author);
            DB::commit();
            return redirect()->route('index_post');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception);
            return redirect()->back()->withInput()->withErrors();
        }
    }

    /**
     * Delete post
     *
     * @param $id
     * @return void
     */
    public function delete($id)
    {
        try {
            $this->postService->delete($id);
            return redirect()->back();
        } catch (\Exception $exception) {
            return redirect()->back()->withInput()->withErrors();
        }
    }

    /**
     * detail post
     *
     * @param $id
     * @return void
     */
    public function detail($id)
    {
        $post = $this->postService->detail($id);
        $author = $this->userDetailService->detail($post->author_id);
        return view('home.post.detail', [
            'post' => $post,
            'author' => $author
        ]);
    }

    /**
     * Upload Image Ckeditor
     *
     * @param PostRequest $request
     * @return void
     */
    public function uploadImage(PostRequest $request)
    {
        try {
            if ($request->uploadImage) {
                $path = 'uploadPost';
                $imgPost = $this->uploadFileTo($request->uploadImage, $path)['fileName'];
                $url = asset('storage/' . $path . '/' . $imgPost);
                return response()->json(['fileName' => $imgPost, 'uploaded' => 1, 'url' => $url]);
            }
        } catch (\Exception $exception) {
            return redirect()->back()->withInput()->withErrors();
        }
    }
}

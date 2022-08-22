<?php

namespace App\Http\Controllers;

use App\Services\Category\CategoryService;
use App\Services\Post\PostService;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function __construct()
    {
        $this->postService = app(PostService::class);
        $this->categoryService = app(CategoryService::class);
        $this->userService = app(UserService::class);
    }

    /**
     * show all list post
     *
     * @return void
     */
    public function index()
    {
        $posts = $this->postService->index();
        return view('home.post.dashbroad', [
            'posts' => $posts,
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
        return view('home.post.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * insert a new post
     *
     * @return void
     */
    public function insert(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->postService->insert($request);
            DB::commit();
            return redirect()->route('index_post');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors();
        }
    }
}

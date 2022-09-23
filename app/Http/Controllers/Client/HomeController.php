<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Category\CategoryService;
use App\Services\Comment\CommentService;
use App\Services\Post\PostService;
use App\Services\UserDetail\UserDetailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->commentService = app(CommentService::class);
        $this->postService = app(PostService::class);
        $this->userDetailService = app(UserDetailService::class);
        $this->categoryService = app(CategoryService::class);
    }

    /**
     * show all list post
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $posts = $this->postService->publicPost(null);
        foreach ($posts as $post) {
            $author = $this->userDetailService->detail($post->author_id);
            $post['avatarUser'] = $author->avatar;
            $post['count'] = count($this->commentService->show($post->id));
        }
        $popularPosts = $this->commentService->allPopularPost();
        $newPosts = $this->postService->allNewPost();
        return view('client.layouts.home', [
            'posts' => $posts,
            'popularPosts' => $popularPosts,
            'newPosts' => $newPosts,
        ]);
    }

    /**
     * show detail post with slug
     *
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function detail($slug)
    {
        $post = $this->postService->slugPostDetail($slug);
        $author = $this->userDetailService->detail($post->author_id);
        $post['avatarUser'] = $author->avatar;
        $post['info'] = $author->author_info;
        $categories = $this->categoryService->countCategory();
        $comments = $this->commentService->show($post->id);
        foreach ($comments as $comment) {
            if (isset($comment->user_id)) {
                $author = $this->userDetailService->detail($comment->user_id);
                $comment['avatarUser'] = $author->avatar;
            }
        }
        return view('client.layouts.detail', [
            'post' => $post,
            'categories' => $categories,
            'comments' => $comments,
        ]);
    }

    /**
     * Find category by slug
     *
     * @param $slug
     * @return void
     */
    public function category($slug)
    {
        $category = $this->categoryService->findCategory($slug);
        $posts = $this->postService->publicPost($category->id);
        foreach ($posts as $post) {
            $author = $this->userDetailService->detail($post->author_id);
            $post['avatarUser'] = $author->avatar;
        }
        return view('client.layouts.category', [
            'posts' => $posts,
            'category' => $category,
        ]);
    }
}

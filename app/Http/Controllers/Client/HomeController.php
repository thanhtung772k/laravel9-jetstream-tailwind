<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Category\CategoryService;
use App\Services\Post\PostService;
use App\Services\UserDetail\UserDetailService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
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
        $posts = $this->postService->publicPost();
        foreach ($posts as $post) {
            $author = $this->userDetailService->detail($post->author_id);
            $post['avatarUser'] = $author->avatar;
        }
        return view('client.layouts.home', [
            'posts' => $posts,
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
        return view('client.layouts.detail', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }
}

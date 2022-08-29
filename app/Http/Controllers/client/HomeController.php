<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Services\Category\CategoryService;
use App\Services\Post\PostService;
use App\Services\User\UserService;
use App\Services\UserDetail\UserDetailService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $posts = $this->postService->publicPost();
        return view('client.layouts.home', [
            'posts' => $posts,
        ]);
    }
}

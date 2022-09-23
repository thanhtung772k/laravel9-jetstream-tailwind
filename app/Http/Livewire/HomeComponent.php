<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Services\Category\CategoryService;
use App\Services\Comment\CommentService;
use App\Services\Post\PostService;
use App\Services\UserDetail\UserDetailService;
use Livewire\Component;

class HomeComponent extends Component
{
//    public $posts = [], $popularPosts = [], $newPosts = [];

    /**
     * show all list post
     *
     * @param CommentService $commentService
     * @param PostService $postService
     * @param UserDetailService $userDetailService
     * @param CategoryService $categoryService
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render(CommentService $commentService, PostService $postService, UserDetailService $userDetailService, CategoryService $categoryService)
    {
        $posts = $postService->publicPost(null);
        foreach ($posts as &$post) {
            $author = $userDetailService->detail($post['author_id']);
            $post['avatarUser'] = $author['avatar'];
            $post['count'] = count($commentService->show($post['id']));
        }
        $popularPosts = $commentService->allPopularPost();
        $newPosts = $postService->allNewPost();
        return view('livewire.home-component', compact('posts', 'popularPosts', 'newPosts'));
    }

    /**
     *
     * @param $slug
     * @return void
     */
    public function getSlug($slug)
    {
        $post = $this->postService->slugPostDetail($slug);
        $this->emit('getPost', $post);
    }
}

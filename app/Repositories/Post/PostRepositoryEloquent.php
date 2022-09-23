<?php

namespace App\Repositories\Post;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class PostRepositoryEloquent.
 *
 * @package namespace App\Repositories\Post;
 */
class PostRepositoryEloquent extends BaseRepository implements PostRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Post::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * show all list post
     *
     * @param $request
     * @return void
     */
    public function index($request)
    {
        return $this->model->join('categories', 'posts.category_id', '=', 'categories.id')
            ->join('users', 'posts.author_id', '=', 'users.id')
            ->select('posts.*', 'categories.name as categoryName', 'users.name as authorName')
            ->where(function ($query) use ($request) {
                return $request->category ? $query->where('category_id', $request->category) : '';
            })->where(function ($query) use ($request) {
                return $request->status ? $query->where('status', $request->status) : '';
            })->where(
                'title', 'like', '%' . $request->title . '%'
            )->where(
                'author_id', Auth::id()
            )->orderBy('created_at', 'asc')->get()->array();
    }

    /**
     * insert a new post
     *
     * @param $request
     * @param $imgPost
     * @param $status
     * @param $slug
     * @return void
     */
    public function insert($request, $imgPost, $status, $slug)
    {
        return $this->model->create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category,
            'author_id' => Auth::id(),
            'image' => $imgPost,
            'status' => $status,
            'slug' => $slug,
            'description' => $request->description
        ]);
    }

    /**
     * find post by slug
     *
     * @param $id
     * @return void
     */
    public function findBySlug($id)
    {
        return $this->model->find($id);
    }

    /**
     * Update post by id
     *
     * @param $request
     * @param $id
     * @param $status
     * @param $imgPost
     * @param $slug
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed|void
     */
    public function updatePost($request, $id, $status, $imgPost, $slug)
    {
        return $this->model->find($id)->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category,
            'image' => $imgPost,
            'status' => $status,
            'slug' => $slug,
            'description' => $request->description
        ]);
    }

    /**
     * Delete post
     *
     * @param $id
     * @return void
     */
    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    /**
     * detail post
     *
     * @param $id
     * @return void
     */
    public function detail($id)
    {
        return $this->model->join('categories', 'posts.category_id', '=', 'categories.id')
            ->join('users', 'posts.author_id', '=', 'users.id')
            ->select('posts.*', 'categories.name as categoryName', 'users.name as authorName')
            ->find($id);
    }

    /**
     * show all public post
     *
     * @return void
     */
    public function publicPost($id = null)
    {
        return $this->model->join('categories', 'posts.category_id', '=', 'categories.id')
            ->join('users', 'posts.author_id', '=', 'users.id')
            ->select(
                'posts.*',
                'categories.name as categoryName',
                'categories.slug as categorySlug',
                'users.name as authorName'
            )->where(function ($query) use ($id) {
                return $id ? $query->where('category_id', $id) : '';
            })->where(
                'status', config('constant.STATUS_PUBLIC')
            )->get();
    }

    /**
     * sho detail post with slug
     *
     * @param $slug
     * @return void
     */
    public function slugPostDetail($slug)
    {
        return $this->model->join('categories', 'posts.category_id', '=', 'categories.id')
            ->join('users', 'posts.author_id', '=', 'users.id')
            ->select('posts.*', 'categories.name as categoryName', 'users.name as authorName')
            ->where([
                ['status', config('constant.STATUS_PUBLIC')],
                ['posts.slug', $slug]
            ])->first();
    }

    /**
     * get all top 4 most interested posts
     *
     * @return mixed
     */
    public function allPopularPost()
    {
        return $this->model->all()
            ->where(
                'status', config('constant.STATUS_PUBLIC')
            )->pluck('post_id')->flatten()->unique()->count();
    }

    /**
     * get all top 4 latest posts
     *
     * @return mixed
     */
    public function allNewPost()
    {
        return $this->model
            ->where(
                'status', config('constant.STATUS_PUBLIC')
            )->orderBy(
                'created_at','desc'
            )->take(4)
            ->get();
    }
}

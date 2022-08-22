<?php

namespace App\Repositories\Post;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
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
     * @return void
     */
    public function index()
    {
        return $this->model->join('categories', 'posts.category_id', '=', 'categories.id')
            ->join('users', 'posts.author_id', '=', 'users.id')
            ->select('posts.*', 'categories.name as categoryName', 'users.name as authorName')
            ->where('author_id', Auth::id())->get();
    }

    /**
     * insert a new post
     *
     * @return void
     */
    public function insert($request, $imgPost, $status)
    {
        return $this->model->create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category,
            'author_id' => Auth::id(),
            'image' => $imgPost,
            'status' => $status
        ]);
    }
}

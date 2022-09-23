<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class CommentRepositoryEloquent.
 *
 * @package namespace App\Repositories\Comment;
 */
class CommentRepositoryEloquent extends BaseRepository implements CommentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Comment::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * user create a new comment
     *
     * @param $request
     * @return void
     */
    public function createCmt($request, $id)
    {
        return $this->model->create([
            'content' => $request->description,
            'post_id' => $request->post_id,
            'user_id' => $id,
            'name' => $request->form_name,
            'email' => $request->form_email,
            'website' => $request->form_website
        ]);
    }

    /**
     * show comment with post id
     *
     * @param $id
     * @return void
     */
    public function show($id)
    {
        return $this->model->where(
            'post_id', $id,
        )->get();
    }

    /**
     * get all top 4 most interested posts
     *
     * @return mixed
     */
    public function allPopularPost()
    {
        return $this->model->with('post')
            ->groupBy('post_id')
            ->select('post_id',
                DB::raw('count(*) as total')
            )->orderBy('total', 'desc')
            ->take(4)
            ->get();
    }
}

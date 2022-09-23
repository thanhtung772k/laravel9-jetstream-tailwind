<?php

namespace App\Services\Comment;

use App\Repositories\Comment\CommentRepository;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

/**
 * Class CommentService
 *
 * @property-read CommentRepository $repository
 *
 * @package App\Services\Comment
 */
class CommentService extends BaseService
{
    /**
     * @return string
     */
    public function repository()
    {
        return CommentRepository::class;
    }

    /**
     * user create a new comment
     *
     * @param $request
     * @return void
     */
    public function create($request)
    {
        if (Auth::check()) {
            $idUser = Auth::id();
        } else {
            $idUser = config('constant.USER_DEFAULT_GUEST');
        }
        return $this->repository->createCmt($request, $idUser);
    }

    /**
     * show comment with post id
     *
     * @param $id
     * @return void
     */
    public function show($id)
    {
        return $this->repository->show($id);
    }

    /**
     * get all top 4 most interested posts
     *
     * @return mixed
     */
    public function allPopularPost()
    {
        return $this->repository->allPopularPost();
    }
}

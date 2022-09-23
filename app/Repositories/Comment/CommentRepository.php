<?php

namespace App\Repositories\Comment;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CommentRepository.
 *
 * @package namespace App\Repositories\Comment;
 */
interface CommentRepository extends RepositoryInterface
{
    /**
     * user create a new comment
     *
     * @param $request
     * @return void
     */
    public function createCmt($request, $id);

    /**
     * show comment with post id
     *
     * @param $id
     * @return void
     */
    public function show($id);

    /**
     * get all top 4 most interested posts
     *
     * @return mixed
     */
    public function allPopularPost();
}

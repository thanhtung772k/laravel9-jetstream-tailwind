<?php

namespace App\Repositories\Post;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PostRepository.
 *
 * @package namespace App\Repositories\Post;
 */
interface PostRepository extends RepositoryInterface
{
    /**
     * show all list post
     *
     * @return void
     */
    public function index();

    /**
     * insert a new post
     *
     * @return void
     */
    public function insert($request, $imgPost, $status);
}

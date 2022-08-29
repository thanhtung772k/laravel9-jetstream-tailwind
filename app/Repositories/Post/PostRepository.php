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
     * @param $request
     * @return void
     */
    public function index($request);

    /**
     * insert a new post
     *
     * @param $request
     * @param $imgPost
     * @param $status
     * @param $slug
     * @return void
     */
    public function insert($request, $imgPost, $status, $slug);

    /**
     * find post by slug
     *
     * @param $id
     * @return void
     */
    public function findBySlug($id);

    /**
     * Update post by id
     *
     * @param $request
     * @param $id
     * @param $status
     * @param $imgEvidence
     * @param $slug
     * @return mixed
     */
    public function updatePost($request, $id, $status, $imgEvidence, $slug);

    /**
     * Delete post
     *
     * @param $id
     * @return void
     */
    public function delete($id);

    /**
     * detail post
     *
     * @param $id
     * @return void
     */
    public function detail($id);

    /**
     * show all public post
     *
     * @return void
     */
    public function publicPost();
}

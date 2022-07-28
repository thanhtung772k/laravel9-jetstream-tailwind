<?php

namespace App\Repositories\UserDetail;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserDetailRepository.
 *
 * @package namespace App\Repositories\UserDetail;
 */
interface UserDetailRepository extends RepositoryInterface
{
    /**
     * insert a new user created resource in storage.
     *
     * @param $request
     * @param $id
     * @param $avatar
     * @return void
     */
    public function insert($request, $id, $avatar);

    /**
     * Show all users
     *
     * @param $request
     * @return void
     */
    public function getAll($request);

    /**
     * Show the form for editing user by ID
     *
     * @param int $id
     * @return mixed
     */
    public function userById($id);

    /**
     * Update user byt id resource in storage.
     *
     * @param $request
     * @param int $id
     * @param string $imgEvidence
     * @return void
     */
    public function updateDetail($request, $id, $imgEvidence);

    /**
     * Delete user by id resource in storage.
     *
     * @param int $id
     * @return mixed
     */
    public function delete($id);

    /**
     * Show all users leave
     *
     * @param $request
     * @return void
     */
    public function userLeave($request);

    /**
     * Show detail user
     *
     * @param int $id
     * @return mixed
     */
    public function detail($id);
}

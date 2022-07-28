<?php

namespace App\Repositories\User;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories\User;
 */
interface UserRepository extends RepositoryInterface
{
    /**
     * Index the repository
     *
     * @return mixed
     */
    public function getAllUser();

    /**
     * get all user admin
     *
     * @return mixed
     */
    public function getAllUserAdmin();

    /**
     * get info user
     *
     * @return void
     */
    public function getUser();

    /**
     * create new user
     *
     * @param $request
     * @param $passDefault
     * @return mixed
     */
    public function insert($request, $passDefault);

    /**
     * get last user
     *
     * @return mixed
     */
    public function getLast();

    /**
     * update information user
     *
     * @param $request
     * @param int $id
     * @return void
     */
    public function updateUser($request, $id);

    /**
     * Delete user by id resource in storage.
     *
     * @param int $id
     * @return mixed
     */
    public function deleteUser($id);

}

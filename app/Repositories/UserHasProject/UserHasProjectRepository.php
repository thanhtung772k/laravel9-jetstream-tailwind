<?php

namespace App\Repositories\UserHasProject;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserHasProjectRepository.
 *
 * @package namespace App\Repositories\UserHasProject;
 */
interface UserHasProjectRepository extends RepositoryInterface
{
    /**
     * save user join project
     *
     * @param $request
     * @param $projectID
     * @return mixed
     */
    public function createUserHasProject($request, $projectID);

    /**
     * update user join project
     *
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id);

    /**
     * create or update user join project
     *
     * @param $request
     * @param $id
     * @return mixed
     */
    public function createOrUpdate($request, $id);

    /**
     * index all project
     *
     * @return mixed
     */
    public function getProject();

    /**
     * get user has project by ID
     *
     * @param $id
     * @return void
     */
    public function getUserHasPrjById($id);

    /**
     * delete user has project
     *
     * @param $request
     * @param $id
     * @return mixed
     */
    public function deleteUserHasProject($request, $id);

    /**
     * detail users join project
     *
     * @param $id
     * @return mixed
     */
    public function detail($id);
}

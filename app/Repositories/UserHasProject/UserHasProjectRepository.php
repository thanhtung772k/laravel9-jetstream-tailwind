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
     * @param $request
     * @param $projectID
     * @return mixed
     */
    public function createUserHasProject($request, $projectID);

    /**
     * update user join project
     * @param $request
     * @param $idPrj
     * @return mixed
     */
    public function update($request, $idPrj);

    /**
     * create or update user join project
     * @param $request
     * @param $idPrj
     * @return mixed
     */
    public function createOrUpdate($request, $idPrj);

    /**
     * index all project
     * @return mixed
     */
    public function getProject();

    /**
     * get user has project by ID
     * @param $idPrj
     * @return void
     */
    public function getUserHasPrjById($idPrj);

    /**
     * delete user has project
     * @param $request
     * @param $idPrj
     * @return mixed
     */
    public function deleteUserHasProject($request, $idPrj);

    /**
     * detail users join project
     * @param $idPrj
     * @return mixed
     */
    public function detail($idPrj);
}

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
     * @param $idPrj
     * @return mixed
     */
    public function deleteUserHasProject($idPrj);
}

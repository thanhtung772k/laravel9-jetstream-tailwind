<?php

namespace App\Services\UserHasProject;

use App\Repositories\UserHasProject\UserHasProjectRepository;
use App\Services\BaseService;

/**
 * Class UserHasProjectService
 *
 * @property-read UserHasProjectRepository $repository
 *
 * @package App\Services\UserHasProject
 */
class UserHasProjectService extends BaseService
{
    /**
     * @return string
     */
    public function repository()
    {
        return UserHasProjectRepository::class;
    }

    /**
     * save user join project
     * @param $request
     * @param $projectID
     * @return mixed
     */
    public function createUserHasProject($request, $projectID)
    {
        return $this->repository->createUserHasProject($request, $projectID);
    }

    /**
     * index all project
     * @return mixed
     */
    public function getProject()
    {
        return $this->repository->getProject();
    }

    /**
     * delete user has project
     * @param $idPrj
     * @return mixed
     */
    public function deleteUserHasProject($idPrj)
    {
        return $this->repository->deleteUserHasProject($idPrj);
    }
}

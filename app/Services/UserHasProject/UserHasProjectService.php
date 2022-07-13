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
     * update user join project
     * @param $request
     * @param $idPrj
     * @return mixed
     */
    public function update($request, $idPrj)
    {
        return $this->repository->update($request, $idPrj);
    }

    /**
     * create or update user join project
     * @param $request
     * @param $idPrj
     * @return mixed
     */
    public function createOrUpdate($request, $idPrj)
    {
        return $this->repository->createOrUpdate($request, $idPrj);
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
     * get user has project by ID
     * @param $idPrj
     * @return void
     */
    public function getUserHasPrjById($idPrj)
    {
        return $this->repository->getUserHasPrjById($idPrj);
    }

    /**
     * delete user has project
     * @param $request
     * @param $idPrj
     * @return mixed
     */
    public function deleteUserHasProject($request, $idPrj)
    {
        return $this->repository->deleteUserHasProject($request, $idPrj);
    }
}

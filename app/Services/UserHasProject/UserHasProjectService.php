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
     *
     * @param $request
     * @param $id
     * @return mixed
     */
    public function createUserHasProject($request, $id)
    {
        return $this->repository->createUserHasProject($request, $id);
    }

    /**
     * update user join project
     *
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id)
    {
        return $this->repository->update($request, $id);
    }

    /**
     * create or update user join project
     *
     * @param $request
     * @param $id
     * @return mixed
     */
    public function createOrUpdate($request, $id)
    {
        return $this->repository->createOrUpdate($request, $id);
    }

    /**
     * index all project
     *
     * @return mixed
     */
    public function getProject()
    {
        return $this->repository->getProject();
    }

    /**
     * get user has project by ID
     *
     * @param $id
     * @return void
     */
    public function getUserHasPrjById($id)
    {
        return $this->repository->getUserHasPrjById($id);
    }

    /**
     * delete user has project
     *
     * @param $request
     * @param $id
     * @return mixed
     */
    public function deleteUserHasProject($request, $id)
    {
        return $this->repository->deleteUserHasProject($request, $id);
    }

    /**
     * detail users join project
     *
     * @param $id
     * @return mixed
     */
    public function detail($id)
    {
        return $this->repository->detail($id);
    }
}

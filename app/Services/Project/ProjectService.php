<?php

namespace App\Services\Project;

use App\Repositories\Project\ProjectRepository;
use App\Services\BaseService;

/**
 * Class ProjectService
 *
 * @property-read ProjectRepository $repository
 *
 * @package App\Services\Project
 */
class ProjectService extends BaseService
{
    /**
     * @return string
     */
    public function repository()
    {
        return ProjectRepository::class;
    }

    /**
     * index all project
     *
     * @param $request
     * @return mixed
     */
    public function getProject($request)
    {
        return $this->repository->getProject($request);
    }

    /**
     * Get index project by id
     *
     * @param $id
     * @return mixed
     */
    public function getProjectById($id)
    {
        return $this->repository->getProjectById($id);
    }

    /**
     * create new project
     *
     * @param $request
     * @return mixed
     */
    public function createProject($request)
    {
        return $this->repository->createProject($request);
    }

    /**
     * get project latest
     *
     * @return mixed
     */
    public function getLastproject()
    {
        return $this->repository->getLastproject();
    }

    /**
     * updae project
     *
     * @param $request
     * @param $id
     * @return void
     */
    public function updateProject($request, $id)
    {
        return $this->repository->updateProject($request, $id);
    }

    /**
     * delete soft project
     *
     * @param $id
     * @return mixed
     */
    public function deleteProject($id)
    {
        return $this->repository->deleteProject($id);
    }

    /**
     * detail information project
     *
     * @param $id
     * @return mixed
     */
    public function detail($id)
    {
        return $this->repository->detail($id);
    }
}

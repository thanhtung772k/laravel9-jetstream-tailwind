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
     * @param $request
     * @return mixed
     */
    public function getProject($request)
    {
        return $this->repository->getProject($request);
    }

    /**
     * create new project
     * @param $request
     * @return mixed
     */
    public function createProject($request)
    {
        return $this->repository->createProject($request);
    }

    /**
     * get project latest
     * @return mixed
     */
    public function getLastproject()
    {
        return $this->repository->getLastproject();
    }

    /**
     * delete soft project
     * @param $idPrj
     * @return mixed
     */
    public function deleteProject($idPrj)
    {
        return $this->repository->deleteProject($idPrj);
    }
}

<?php

namespace App\Services\ProjectType;

use App\Repositories\ProjectType\ProjectTypeRepository;
use App\Services\BaseService;

/**
 * Class ProjectTypeService
 *
 * @property-read ProjectTypeRepository $repository
 *
 * @package App\Services\ProjectType
 */
class ProjectTypeService extends BaseService
{
    /**
     * @return string
     */
    public function repository()
    {
        return ProjectTypeRepository::class;
    }

    /**
     * index project type
     *
     * @return mixed
     */
    public function getProjectType()
    {
        return $this->repository->getProjectType();
    }

}

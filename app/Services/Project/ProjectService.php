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
}

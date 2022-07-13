<?php

namespace App\Repositories\ProjectType;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ProjectTypeRepository.
 *
 * @package namespace App\Repositories\ProjectType;
 */
interface ProjectTypeRepository extends RepositoryInterface
{
    /**
     * index project type
     * @return mixed
     */
    public function getProjectType();
}

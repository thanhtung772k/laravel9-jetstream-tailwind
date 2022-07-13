<?php

namespace App\Repositories\Project;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ProjectRepository.
 *
 * @package namespace App\Repositories\Project;
 */
interface ProjectRepository extends RepositoryInterface
{
    /**
     * index all project
     * @param $request
     * @return mixed
     */
    public function getProject($request);

    /**
     * create new project
     * @param $request
     * @return mixed
     */
    public function createProject($request);

    /**
     * get project latest
     * @return mixed
     */
    public function getLastproject();

    /**
     * delete soft project
     * @param $idPrj
     * @return mixed
     */
    public function deleteProject($idPrj);
}

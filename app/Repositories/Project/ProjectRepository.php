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
     *
     * @param $request
     * @return mixed
     */
    public function getProject($request);

    /**
     * Get index project by id
     *
     * @param $id
     * @return mixed
     */
    public function getProjectById($id);

    /**
     * create new project
     *
     * @param $request
     * @return mixed
     */
    public function createProject($request);

    /**
     * updae project
     *
     * @param $request
     * @param $id
     * @return void
     */
    public function updateProject($request, $idPr);

    /**
     * get project latest
     *
     * @return mixed
     */
    public function getLastproject();

    /**
     * delete soft project
     *
     * @param $id
     * @return mixed
     */
    public function deleteProject($id);

    /**
     * detail information project
     *
     * @param $id
     * @return mixed
     */
    public function detail($id);
}

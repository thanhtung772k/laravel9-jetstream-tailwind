<?php

namespace App\Repositories\Project;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Project;


/**
 * Class ProjectRepositoryEloquent.
 *
 * @package namespace App\Repositories\Project;
 */
class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Project::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * index all project
     * @param $request
     * @return mixed
     */
    public function getProject($request)
    {
        return $this->model->join('projects_type', 'projects.project_type_id', '=', 'projects_type.id')
            ->join('departments', 'projects.departments_id', '=', 'departments.id')
            ->select('projects.*', 'projects_type.name as namePrj', 'departments.name as nameDept')
            ->where('projects.name', 'like', '%' . $request->prjName . '%')
            ->where(function ($query) use ($request) {
                return $request->prjStatus ? $query->where('status', $request->prjStatus) : '';
            })->where(function ($query) use ($request) {
                return $request->prjTypeID ? $query->where('project_type_id', $request->prjTypeID) : '';
            })->where(function ($query) use ($request) {
                return $request->prjDept ? $query->where('departments_id', $request->prjDept) : '';
            })->get();
    }

    /**
     * create new project
     * @param $request
     * @return mixed
     */
    public function createProject($request)
    {
        return $this->model->create([
            'name' => $request->projectName,
            'customer' => $request->customer,
            'project_type_id' => $request->projectType,
            'departments_id' => $request->department,
            'vale_contract' => $request->valueContract,
            'start_date' => $request->startDateProject,
            'end_date' => $request->endDateProject,
            'status' => $request->statusProject,
            'description' => $request->discription,
        ]);
    }

    /**
     * get project latest
     * @param $request
     * @return mixed
     */
    public function getLastproject()
    {
        return $this->model->latest()->first();
    }

    /**
     * delete soft project
     * @param $idPrj
     * @return mixed
     */
    public function deleteProject($idPrj)
    {
        return $this->model->find($idPrj)->delete();
    }
}

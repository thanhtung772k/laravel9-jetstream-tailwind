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
     *
     * @param $request
     * @return mixed
     */
    public function getProject($request)
    {
        return $this->model->join('projects_type', 'projects.project_type_id', '=', 'projects_type.id')
            ->join('departments', 'projects.department_id', '=', 'departments.id')
            ->select('projects.*', 'projects_type.name as namePrj', 'departments.name as nameDept')
            ->where('projects.name', 'like', '%' . $request->prjName . '%')
            ->where(function ($query) use ($request) {
                return $request->prjStatus ? $query->where('status', $request->prjStatus) : '';
            })->where(function ($query) use ($request) {
                return $request->prjTypeID ? $query->where('project_type_id', $request->prjTypeID) : '';
            })->where(function ($query) use ($request) {
                return $request->prjDept ? $query->where('department_id', $request->prjDept) : '';
            })->orderBy('created_at', 'asc')->get();
    }

    /**
     * Get index project by id
     *
     * @param $id
     * @return mixed
     */
    public function getProjectById($id)
    {
        return $this->model->find($id);
    }

    /**
     * create new project
     *
     * @param $request
     * @return mixed
     */
    public function createProject($request)
    {
        return $this->model->create([
            'name' => $request->project_name,
            'customer' => $request->customer,
            'project_type_id' => $request->projectType,
            'department_id' => $request->department,
            'value_contract' => $request->value_contract,
            'start_date' => $request->start_date_project,
            'end_date' => $request->end_date_project,
            'status' => $request->statusProject,
            'description' => $request->description,
        ]);
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
        return $this->model->find($id)->update([
            'name' => $request->project_name,
            'customer' => $request->customer,
            'project_type_id' => $request->projectType,
            'department_id' => $request->department,
            'value_contract' => $request->value_contract,
            'start_date' => $request->start_date_project,
            'end_date' => $request->end_date_project,
            'status' => $request->statusProject,
            'description' => $request->description,
        ]);
    }

    /**
     * get project latest
     *
     * @param $request
     * @return mixed
     */
    public function getLastproject()
    {
        return $this->model->latest()->first();
    }

    /**
     * delete soft project
     *
     * @param $id
     * @return mixed
     */
    public function deleteProject($id)
    {
        return $this->model->join('projects_type', 'projects.project_type_id', '=', 'projects_type.id')
            ->join('departments', 'projects.department_id', '=', 'departments.id')->find($id);
    }

    /**
     * detail information project
     *
     * @param $id
     * @return mixed
     */
    public function detail($id)
    {
        return $this->model->find($id);
    }
}

<?php

namespace App\Repositories\Department;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Department;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories\Department;
 */
class DepartmentRepositoryEloquent extends BaseRepository implements DepartmentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Department::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * get all department
     *
     * @return mixed
     */
    public function getDepartment()
    {
        return $this->model->all();
    }

}

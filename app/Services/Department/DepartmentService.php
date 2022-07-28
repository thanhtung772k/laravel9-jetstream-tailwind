<?php

namespace App\Services\Department;

use App\Repositories\Department\DepartmentRepository;
use App\Services\BaseService;
use App\Traits\ManageFile;

/**
 * Class DepartmentService
 *
 * @property-read DepartmentRepository $repository
 *
 * @package App\Services\Department
 */
class DepartmentService extends BaseService
{
    use ManageFile;

    /**
     * @return string
     */
    public function repository()
    {
        return DepartmentRepository::class;
    }

    /**
     * get all department
     *
     * @return mixed
     */
    public function getDepartment()
    {
        return $this->repository->getDepartment();
    }
}

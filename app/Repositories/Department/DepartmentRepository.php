<?php

namespace App\Repositories\Department;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface DepartmentRepository.
 *
 * @package namespace App\Repositories\Department;
 */
interface DepartmentRepository extends RepositoryInterface
{
    /**
     * get all department
     * @return mixed
     */
    public function getDepartment();
}

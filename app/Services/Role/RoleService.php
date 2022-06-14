<?php

namespace App\Services\Role;

use App\Repositories\Role\RoleRepository;
use App\Services\BaseService;

/**
 * Class RoleService
 *
 * @property-read RoleRepository $repository
 *
 * @package App\Services\Role
 */
class RoleService extends BaseService
{
    /**
     * @return string
     */
    public function repository()
    {
        return RoleRepository::class;
    }

    /**
     * get list Location
     * @return mixed
     */
    public function getLocation()
    {
        return $this->repository->getLocation();
    }
}

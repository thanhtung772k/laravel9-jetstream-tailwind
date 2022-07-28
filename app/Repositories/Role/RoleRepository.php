<?php

namespace App\Repositories\Role;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface RoleRepository.
 *
 * @package namespace App\Repositories\Role;
 */
interface RoleRepository extends RepositoryInterface
{
    /**
     * get list Location
     *
     * @return mixed
     */
    public function getLocation();
}

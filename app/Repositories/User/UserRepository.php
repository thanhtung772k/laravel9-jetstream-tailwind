<?php

namespace App\Repositories\User;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories\User;
 */
interface UserRepository extends RepositoryInterface
{
    /**
     * Index the repository
     */
    public function getAllUser();

    /**
     * get all user admin
     * @return mixed
     */
    public function getAllUserAdmin();
}

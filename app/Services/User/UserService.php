<?php

namespace App\Services\User;

use App\Repositories\User\UserRepository;
use App\Services\BaseService;

/**
 * Class UserService
 *
 * @property-read UserRepository $repository
 *
 * @package App\Services\User
 */
class UserService extends BaseService
{
    /**
     * @return string
     */
    public function repository()
    {
        return UserRepository::class;
    }

    /**
     * get all user Index Service
     */
    public function getAllUser()
    {
        return $this->repository->getAllUser();
    }

    /**
     * get all user admin
     * @return mixed
     */
    public function getAllUserAdmin()
    {
        return $this->repository->getAllUserAdmin();
    }
}

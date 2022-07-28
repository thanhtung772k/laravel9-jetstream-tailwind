<?php

namespace App\Services\User;

use App\Repositories\User\UserRepository;
use App\Services\BaseService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
     *
     * @return mixed
     */
    public function getAllUser()
    {
        return $this->repository->getAllUser();
    }

    /**
     * get all user admin
     *
     * @return mixed
     */
    public function getAllUserAdmin()
    {
        return $this->repository->getAllUserAdmin();
    }

    /**
     * get info user
     *
     * @return void
     */
    public function getUser()
    {
        return $this->repository->getUser();
    }

    /**
     * create new user
     *
     * @param $request
     * @param string $passDefault
     * @return mixed
     */
    public function insert($request, $passDefault)
    {
        return $this->repository->insert($request, $passDefault);
    }

    /**
     * get last user
     *
     * @return mixed
     */
    public function getLast()
    {
        return $this->repository->getLast();
    }

    /**
     * update information user
     *
     * @param $request
     * @param int $id
     * @return void
     */
    public function updateUser($request, $id)
    {
        return $this->repository->updateUser($request, $id);
    }

    /**
     * Delete user by id resource in storage.
     *
     * @param int $id
     * @return mixed
     */
    public function deleteUser($id)
    {
        return $this->repository->deleteUser($id);
    }
}

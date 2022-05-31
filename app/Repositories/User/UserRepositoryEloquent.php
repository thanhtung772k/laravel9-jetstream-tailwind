<?php

namespace App\Repositories\User;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\User\UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories\User;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Index all user the repository
     */
    public function getAllUser()
    {
        return $this->model->all();
    }

    /**
     * get all user admin
     * @return mixed
     */
    public function getAllUserAdmin()
    {
        return $this->model->where('is_admin', config('constant.is_admin'))->get();
    }

    /**
     * get info user
     * @return void
     */
    public function getUser()
    {
        return $this->model->where('id',Auth::id())->first();
    }
}

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
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getAllUser()
    {
        return $this->model->all();
    }

    /**
     * get all user admin
     *
     * @return mixed
     */
    public function getAllUserAdmin()
    {
        return $this->model->where(
            'is_admin', config('constant.is_admin')
        )->get();
    }

    /**
     * get info user
     *
     * @return void
     */
    public function getUser()
    {
        return $this->model->where(
            'id', Auth::id()
        )->first();
    }

    /**
     * create new user
     *
     * @param $request
     * @param $passDefault
     * @return mixed
     */
    public function insert($request, $passDefault)
    {
        return $this->model->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $passDefault,
        ]);
    }

    /**
     * get last user
     *
     * @return mixed
     */
    public function getLast()
    {
        return $this->model->latest()->first();
    }

    /**
     * update information user
     *
     * @param $request
     * @param $id
     * @return void
     */
    public function updateUser($request, $id)
    {
        return $this->model->where(
            'id', $id
        )->update([
            'name' => $request->name,
        ]);
    }

    /**
     * Delete user by id resource in storage.
     *
     * @param $id
     * @return mixed
     */
    public function deleteUser($id)
    {
        return $this->model->where(
            'id', $id
        )->delete();
    }

    /**
     * get all user
     *
     * @param $date
     * @param $employee_code
     * @return void
     */
    public function index($date, $employee_code)
    {
        return $this->model->join('timesheets', 'users.id', '=', 'timesheets.user_id')
            ->join('user_details', 'users.id', '=', 'user_details.user_id')
            ->select('timesheets.date',
                'timesheets.id as time_id',
                'timesheets.user_id as user_id',
                'user_details.employee_code'
            )->where([
                ['timesheets.date', $date],
                ['user_details.employee_code', $employee_code]
            ])->get();
    }
}

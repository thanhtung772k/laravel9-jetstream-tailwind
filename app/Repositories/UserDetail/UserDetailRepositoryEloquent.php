<?php

namespace App\Repositories\UserDetail;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\UserDetail;

/**
 * Class UserDetailRepositoryEloquent.
 *
 * @package namespace App\Repositories\UserDetail;
 */
class UserDetailRepositoryEloquent extends BaseRepository implements UserDetailRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return UserDetail::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * insert a new user created resource in storage.
     *
     * @param $request
     * @param $id
     * @param $avatar
     * @return void
     */
    public function insert($request, $id, $avatar)
    {

        return $this->model->create([
            'employee_code' => $request->user_id,
            'date_of_birth' => $request->date_of_birth,
            'home_town' => $request->homeTown,
            'current_residence' => $request->currentResidence,
            'university' => $request->university,
            'working_form' => $request->workForm,
            'time_start' => $request->time_start,
            'member_company' => $request->member_comp,
            'position_id' => $request->position,
            'department_id' => $request->dept,
            'role_id' => $request->location,
            'japanese' => $request->japanese,
            'avatar' => $avatar,
            'national' => $request->nationality,
            'ethnic' => $request->ethnic,
            'phone' => $request->phone,
            'relative_phone' => $request->relativePhone,
            'passport' => $request->passport,
            'date_range' => $request->dateRange,
            'place_issue' => $request->placeOfIssue,
            'visa' => $request->visa,
            'duration_visa' => $request->duration,
            'link_fb' => $request->linkFB,
            'user_id' => $id,
            'gender' => $request->gender,
        ]);
    }

    /**
     * Show all users
     *
     * @param $request
     * @return void
     */
    public function getAll($request)
    {
        return $this->model
            ->join('users', 'user_details.user_id', '=', 'users.id')
            ->join('departments', 'user_details.department_id', '=', 'departments.id')
            ->select(
                'user_details.*',
                'user_details.id as userDetailId',
                'users.*'
            )
            ->where(
                'user_details.employee_code', 'like', '%' . $request->user_id . '%'
            )->where(
                'users.name', 'like', '%' . $request->user_name . '%'
            )->where(function ($query) use ($request) {
                return $request->location ? $query->where('role_id', $request->location) : '';
            })
            ->where(function ($query) use ($request) {
                return $request->dept ? $query->where('department_id', $request->dept) : '';
            })
            ->sortable()->paginate(config('constant.PAGINATE_VALUE'));
    }

    /**
     * Show the form for editing user by ID
     *
     * @param int $id
     * @return mixed
     */
    public function userById($id)
    {
        return $this->model->join('users', 'user_details.user_id', '=', 'users.id')
            ->join('departments', 'user_details.department_id', '=', 'departments.id')
            ->select(
                'user_details.*',
                'user_details.id as userDetailId',
                'users.*'
            )->find($id);
    }

    /**
     * Update user byt id resource in storage.
     *
     * @param $request
     * @param int $id
     * @param string $imgEvidence
     * @return void
     */
    public function updateDetail($request, $id, $imgEvidence)
    {
        return $this->model->where('user_id', $id)->update([
            'date_of_birth' => $request->date_of_birth,
            'home_town' => $request->homeTown,
            'current_residence' => $request->currentResidence,
            'university' => $request->university,
            'working_form' => $request->workForm,
            'time_start' => $request->time_start,
            'member_company' => $request->member_comp,
            'position_id' => $request->position,
            'department_id' => $request->dept,
            'role_id' => $request->location,
            'japanese' => $request->japanese,
            'avatar' => $imgEvidence,
            'national' => $request->nationality,
            'ethnic' => $request->ethnic,
            'phone' => $request->phone,
            'relative_phone' => $request->relativePhone,
            'passport' => $request->passport,
            'date_range' => $request->dateRange,
            'place_issue' => $request->placeOfIssue,
            'visa' => $request->visa,
            'duration_visa' => $request->duration,
            'link_fb' => $request->linkFB,
            'gender' => $request->gender,
        ]);
    }

    /**
     * Delete user by id resource in storage.
     *
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->where('user_id', $id)->delete();
    }

    /**
     * Show all users leave
     *
     * @param $request
     * @return void
     */
    public function userLeave($request)
    {
        return $this->model->onlyTrashed()
            ->join('users', 'user_details.user_id', '=', 'users.id')
            ->join('departments', 'user_details.department_id', '=', 'departments.id')
            ->select(
                'user_details.*',
                'user_details.id as userDetailId',
                'users.*'
            )->where(
                'user_details.employee_code', 'like', '%' . $request->user_id . '%'
            )->where(
                'users.name', 'like', '%' . $request->user_name . '%'
            )->where(function ($query) use ($request) {
                return $request->location ? $query->where('role_id', $request->location) : '';
            })->where(function ($query) use ($request) {
                return $request->dept ? $query->where('department_id', $request->dept) : '';
            })->orderBy(
                'employee_code', 'asc'
            )->paginate(config('constant.PAGINATE_VALUE'));
    }

    /**
     * Show detail user
     *
     * @param int $id
     * @return mixed
     */
    public function detail($id)
    {
        return $this->model->where(
            'user_id', $id
        )->first();
    }
}

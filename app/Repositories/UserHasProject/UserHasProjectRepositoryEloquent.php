<?php

namespace App\Repositories\UserHasProject;

use App\Models\UserHasProject;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class UserHasProjectRepositoryEloquent.
 *
 * @package namespace App\Repositories\UserHasProject;
 */
class UserHasProjectRepositoryEloquent extends BaseRepository implements UserHasProjectRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserHasProject::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * save user join project
     *
     * @param $request
     * @param $projectID
     * @return mixed
     */
    public function createUserHasProject($request, $projectID)
    {
        //Delete all user of project.
        $this->model->where(
            'project_id', $projectID
        )->delete();
        foreach ($request->user_id as $key => $value) {
            $this->model->create([
                'user_id' => $request->user_id[$key],
                'project_id' => $projectID,
                'role_id' => $request->locationID[$key],
                'start_date' => $request->start_date_user[$key],
                'end_date' => $request->end_date_user[$key],
                'effort' => $request->effort[$key]
            ]);
        }
    }

    /**
     * update user join project
     *
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id)
    {
        foreach ($request->user_has_id_old as $key => $value) {
            if (isset($request->user_has_id_old[$key])) {
                $this->model->find($request->user_has_id_old[$key])->update([
                    'user_id' => $request->user_id[$key],
                    'role_id' => $request->locationID[$key],
                    'start_date' => $request->start_date_user[$key],
                    'end_date' => $request->end_date_user[$key],
                    'effort' => $request->effort[$key]
                ]);
            }
        }
    }

    /**
     * create or update user join project
     *
     * @param $request
     * @param $id
     * @return mixed
     */
    public function createOrUpdate($request, $id)
    {
        foreach ($request->user_has_id_old as $key => $value) {
            if ($request->user_has_id_old[$key] === null) {
                $this->model->create([
                    'user_id' => $request->user_id[$key],
                    'project_id' => $id,
                    'role_id' => $request->locationID[$key],
                    'start_date' => $request->start_date_user[$key],
                    'end_date' => $request->end_date_user[$key],
                    'effort' => $request->effort[$key]
                ]);
            }
        }
    }

    /**
     * index all project
     *
     * @return mixed
     */
    public function getProject()
    {
        return $this->model->all();
    }

    /**
     * get user has project by ID
     *
     * @param $id
     * @return void
     */
    public function getUserHasPrjById($id)
    {
        return $this->model->where(
            'project_id', $id
        )->get();
    }

    /**
     * delete user has project
     *
     * @param $request
     * @param $id
     * @return mixed
     */
    public function deleteUserHasProject($request, $id)
    {
        $this->model->where(
            'project_id', $id
        )->where(function ($query) use ($request) {
            return $request->user_has_id_old ? $query->whereNotIn('id', array_filter($request->user_has_id_old)) : '';
        })->delete();
    }

    /**
     * detail users join project
     *
     * @param $id
     * @return mixed
     */
    public function detail($id)
    {
        return $this->model->join('users', 'user_has_projects.user_id', '=', 'users.id')
            ->join('roles', 'user_has_projects.role_id', '=', 'roles.id')
            ->select(
                'user_has_projects.*',
                'users.name',
                'roles.name as nameRole'
            )->where(
                'project_id', $id
            )->get();
    }


    /**
     * get all user working
     *
     * @return mixed
     */
    public function working()
    {
        $data = $this->model->groupBy('user_id')
            ->where([
                ['end_date','>=', config('constant.now')],
                ['start_date','<=', config('constant.now')]
            ])->pluck('user_id')->toArray();
        return $data;
    }
}

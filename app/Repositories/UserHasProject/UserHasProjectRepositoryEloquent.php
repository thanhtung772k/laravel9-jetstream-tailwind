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
     * @param $request
     * @param $projectID
     * @return mixed
     */
    public function createUserHasProject($request, $projectID)
    {
        //Delete all user of project.
        $this->model->where('project_id', $projectID)->delete();
        foreach ($request->userID as $key => $value) {
            $this->model->create([
                'user_id' => $request->userID[$key],
                'project_id' => $projectID,
                'role_id' => $request->locationID[$key],
                'start_date' => $request->startDateUser[$key],
                'end_date' => $request->endDateUser[$key],
                'effort' => $request->effort[$key]
            ]);
        }
    }

    /**
     * update user join project
     * @param $request
     * @param $idPrj
     * @return mixed
     */
    public function update($request, $idPrj)
    {
        foreach ($request->userHasIDOld as $key => $value) {
            if (isset($request->userHasIDOld[$key])) {
                $this->model->find($request->userHasIDOld[$key])->update([
                    'user_id' => $request->userID[$key],
                    'role_id' => $request->locationID[$key],
                    'start_date' => $request->startDateUser[$key],
                    'end_date' => $request->endDateUser[$key],
                    'effort' => $request->effort[$key]
                ]);
            }
        }
    }

    /**
     * create or update user join project
     * @param $request
     * @param $idPrj
     * @return mixed
     */
    public function createOrUpdate($request, $idPrj)
    {
        foreach ($request->userHasIDOld as $key => $value) {
            if ($request->userHasIDOld[$key] === null) {
                $this->model->create([
                    'user_id' => $request->userID[$key],
                    'project_id' => $idPrj,
                    'role_id' => $request->locationID[$key],
                    'start_date' => $request->startDateUser[$key],
                    'end_date' => $request->endDateUser[$key],
                    'effort' => $request->effort[$key]
                ]);
            }
        }
    }

    /**
     * index all project
     * @return mixed
     */
    public function getProject()
    {
        return $this->model->all();
    }

    /**
     * get user has project by ID
     * @param $idPrj
     * @return void
     */
    public function getUserHasPrjById($idPrj)
    {
        return $this->model->where('project_id', $idPrj)->get();
    }

    /**
     * delete user has project
     * @param $request
     * @param $idPrj
     * @return mixed
     */
    public function deleteUserHasProject($request, $idPrj)
    {
        $this->model->where('project_id', $idPrj)->where(function ($query) use ($request) {
            return $request->userHasIDOld ? $query->whereNotIn('id', array_filter($request->userHasIDOld)) : '';
        })->delete();
    }
}

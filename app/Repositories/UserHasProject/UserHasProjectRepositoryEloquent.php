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
     * index all project
     * @return mixed
     */
    public function getProject()
    {
        return $this->model->all();
    }

    /**
     * delete user has project
     * @param $idPrj
     * @return mixed
     */
    public function deleteUserHasProject($idPrj)
    {
        return $this->model->find($idPrj)->delete();
    }
}

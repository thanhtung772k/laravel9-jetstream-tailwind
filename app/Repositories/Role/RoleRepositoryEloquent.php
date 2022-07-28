<?php

namespace App\Repositories\Role;

use App\Models\Role;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class RoleRepositoryEloquent.
 *
 * @package namespace App\Repositories\Role;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * get list Location
     *
     * @return mixed
     */
    public function getLocation()
    {
        return $this->model->all();
    }

}

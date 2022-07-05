<?php

namespace App\Repositories\ProjectType;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\ProjectType;

/**
 * Class ProjectTypeRepositoryEloquent.
 *
 * @package namespace App\Repositories\ProjectType;
 */
class ProjectTypeRepositoryEloquent extends BaseRepository implements ProjectTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectType::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * index project type
     * @return mixed
     */
    public function getProjectType()
    {
        return $this->model->all();
    }

}

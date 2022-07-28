<?php

namespace App\Repositories\Position;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Position;

/**
 * Class PositionRepositoryEloquent.
 *
 * @package namespace App\Repositories\Position;
 */
class PositionRepositoryEloquent extends BaseRepository implements PositionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Position::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * get all list Position
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->all();
    }

}

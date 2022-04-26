<?php

namespace App\Repositories\AddTimesheet;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AddTimesheet\AddTimesheetRepository;
use App\Models\AddTimesheet;

/**
 * Class AddTimesheetRepositoryEloquent.
 *
 * @package namespace App\Repositories\AddTimesheet;
 */
class AddTimesheetRepositoryEloquent extends BaseRepository implements AddTimesheetRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AddTimesheet::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}

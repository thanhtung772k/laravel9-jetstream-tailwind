<?php

namespace App\Repositories\Timekeeping;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Timekeeping;


/**
 * Class TimekeepingRepositoryEloquent.
 *
 * @package namespace App\Repositories\Timekeeping;
 */
class TimekeepingRepositoryEloquent extends BaseRepository implements TimekeepingRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Timekeeping::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * group by timekeeping by eployee_code
     *
     * @return void
     */
    public function groupBy()
    {
        return $this->model->where(
            'status', config('constant.VALUE_DEFAULT_ZERO')
        )->pluck('id', 'employee_code');
    }

    /**
     * select min or max
     *
     * @param $id
     * @param $method
     * @return mixed
     */
    public function maxOrMin($id, $method)
    {
        return $this->model->where(
            'employee_code', $id
        )->where(
            'status', config('constant.VALUE_DEFAULT_ZERO')
        )->$method('date_time');
    }

    /**
     * update status
     *
     * @param $employeeCode
     * @return mixed
     */
    public function updateStatus($employeeCode)
    {
        return $this->model->where(
            'employee_code', $employeeCode
        )->update([
            'status' => config('constant.VALUE_DEFAULT_ONE')
        ]);
    }
}

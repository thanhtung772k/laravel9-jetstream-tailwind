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
     * @param $code
     * @return void
     */
    public function groupBy($code)
    {
        return $this->model->where([
            ['employee_code', $code],
            ['status', 0]
        ])->pluck('date_time')->toArray();
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
            'status' => 1
        ]);
    }
}

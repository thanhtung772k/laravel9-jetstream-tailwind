<?php

namespace App\Services\Timekeeping;

use App\Repositories\Timekeeping\TimekeepingRepository;
use App\Services\BaseService;

/**
 * Class TimekeepingService
 *
 * @property-read TimekeepingRepository $repository
 *
 * @package App\Services\Timekeeping
 */
class TimekeepingService extends BaseService
{
    /**
     * @return string
     */
    public function repository()
    {
        return TimekeepingRepository::class;
    }

    /**
     * group by timekeeping by eployee_code
     *
     * @return void
     */
    public function groupBy()
    {
        return $this->repository->groupBy();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function maxOrMin($id, $method)
    {
        return $this->repository->maxOrMin($id, $method);
    }

    /**
     * update status
     *
     * @param $employeeCode
     * @return mixed
     */
    public function updateStatus($employeeCode)
    {
        return $this->repository->updateStatus($employeeCode);
    }
}

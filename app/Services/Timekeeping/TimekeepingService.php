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
     * @param $code
     * @return void
     */
    public function groupBy($code)
    {
        return $this->repository->groupBy($code);
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

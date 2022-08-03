<?php

namespace App\Repositories\Timekeeping;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TimekeepingRepository.
 *
 * @package namespace App\Repositories\Timekeeping;
 */
interface TimekeepingRepository extends RepositoryInterface
{
    /**
     * group by timekeeping by eployee_code
     *
     * @return void
     */
    public function groupBy();

    /**
     * get max or min timekeeping
     *
     * @param $id
     * @return mixed
     */
    public function maxOrMin($id, $method);

    /**
     * update status
     *
     * @param $employeeCode
     * @return mixed
     */
    public function updateStatus($employeeCode);
}

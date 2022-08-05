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
     * @param $code
     * @return void
     */
    public function groupDate($code);

    /**
     * update status
     *
     * @param $employeeCode
     * @return mixed
     */
    public function updateStatus($employeeCode);
}

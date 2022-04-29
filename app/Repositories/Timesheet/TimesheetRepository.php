<?php

namespace App\Repositories\Timesheet;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TimeSheetRepository.
 *
 * @package namespace App\Repositories\TimeSheet;
 */
interface TimesheetRepository extends RepositoryInterface
{
    /**
     * Index the repository
     */
    public function getTimesheet();

    /**
     * Search date the repository
     * @param $fromDate
     * @param $toDate
     * @return mixed
     */
    public function searchDateTimesheet($fromDate,$toDate);
}

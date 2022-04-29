<?php

namespace App\Services\Timesheet;

use App\Repositories\Timesheet\TimesheetRepository;
use App\Services\BaseService;

/**
 * Class TimesheetService
 *
 * @property-read TimesheetRepository $repository
 *
 * @package App\Services\Timesheet
 */
class TimesheetService extends BaseService
{
    /**
     * @return string
     */
    public function repository()
    {
        return TimesheetRepository::class;
    }

    /**
     * get Timesheet Index Service
     */
    public function getTimesheet()
    {
        return $this->repository->getTimesheet();
    }

    /**
     * search date Timesheet
     * @param $fromDate
     * @param $toDate
     * @return mixed
     */
    public function searchDateTimesheet($fromDate, $toDate)
    {
        return $this->repository->searchDateTimesheet($fromDate, $toDate);
    }
}

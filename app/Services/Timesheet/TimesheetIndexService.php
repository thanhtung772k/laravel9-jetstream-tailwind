<?php

namespace App\Services\Timesheet;


/**
 * Class TimesheetIndexService
 *
 * @package App\Services\Timesheet
 */
class TimesheetIndexService extends TimesheetService
{
    private $timesheetRopsitory;

    /**
     * get all Timesheet
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function getListTimesheet()
    {
        return $this->timesheetRopsitory->getTimesheet();
    }
}

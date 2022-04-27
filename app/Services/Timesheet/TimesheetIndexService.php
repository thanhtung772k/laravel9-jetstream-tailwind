<?php

namespace App\Services\Timesheet;


/**
 * Class TimesheetIndexService
 *
 * @package App\Services\Timesheet
 */
class TimesheetIndexService extends TimesheetService
{
    /**
     * get all Timesheet
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function getListTimesheet()
    {
        $tab = $this->repository->getTimesheet();
        return $this->sendResponse(trans('success.S002.message'), $tab, $tab->count());
    }
}

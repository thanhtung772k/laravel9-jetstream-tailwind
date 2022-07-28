<?php

namespace App\Services\Timesheet;

use App\Repositories\Timesheet\TimesheetRepository;
use App\Services\BaseService;
use App\Traits\HandleDay;

/**
 * Class TimesheetService
 *
 * @property-read TimesheetRepository $repository
 *
 * @package App\Services\Timesheet
 */
class TimesheetService extends BaseService
{
    use HandleDay;

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
     * index and search date Timesheet
     *
     * @param $request
     * @return mixed
     */
    public function searchDateTimesheet($request)
    {

        return $this->repository->searchDateTimesheet($request);
    }

    /**
     * checkin date Timesheet
     *
     * @param $checkInDate
     * @param $checkInHour
     * @return mixed
     */
    public function checkIndateTimesheet($checkInDate, $checkInHour)
    {
        return $this->repository->checkIndateTimesheet($checkInDate, $checkInHour);
    }

    /**
     * checkout date Timesheet
     *
     * @param $timesheets
     * @param $checkOutDate
     * @param $checkOutHour
     * @return mixed
     */
    public function checkOutdateTimesheet($timesheets, $checkOutDate, $checkOutHour)
    {
        //get check_in from db
        foreach ($timesheets as $value) {
            if ($value->date == $checkOutDate) {
                $checkInHour = $value->check_in;
            }
        }
        return $this->repository->checkOutdateTimesheet($checkInHour, $checkOutDate, $checkOutHour);
    }

    /**
     * create new date Timesheet after 0h
     *
     * @param $date
     * @param $id
     * @return mixed
     */
    public function createDate($date, $id)
    {
        return $this->repository->createDate($date, $id);
    }

    /**
     * get AddTimesheet Index Service
     *
     * @param $timesheetID
     * @return mixed
     */
    public function getIDTimesheet($timesheetID)
    {
        try {
            return $this->repository->getIDTimesheet($timesheetID);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * get date timesheet now
     *
     * @param $dateTime
     * @return mixed
     */
    public function dateTimesheet($dateTime)
    {
        return $this->repository->dateTimesheet($dateTime);
    }

    /**
     * get date timesheet early
     *
     * @return mixed
     */
    public function dateTimesheetEarly()
    {
        return $this->repository->dateTimesheetEarly();
    }

    /**
     * count timesheet
     *
     * @return mixed
     */
    public function countTimesheet()
    {
        return $this->repository->countTimesheet();
    }

    /**
     * update timesheet
     *
     * @return void
     */
    public function approval($request)
    {
        $getTimesheet = $this->updateTimesheet($request->checkInReq, $request->checkOutReq);
        return $this->repository->approval($request, $getTimesheet['actWorking'], $getTimesheet['paidWorking']);
    }

    /**
     * update many timesheets
     *
     * @param $data
     * @return void
     */
    public function approvalMany($data)
    {
        $getTimesheet = $this->updateTimesheet($data->check_int_request, $data->check_out_request);
        return $this->repository->approvalMany($data, $getTimesheet['actWorking'], $getTimesheet['paidWorking']);
    }
}

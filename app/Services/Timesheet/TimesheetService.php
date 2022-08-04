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
     *
     * @param $id
     * @return mixed
     */
    public function getTimesheet($id)
    {
        return $this->repository->getTimesheet($id);
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
     * @param $id
     * @return mixed
     */
    public function checkIndateTimesheet($checkInDate, $checkInHour, $id)
    {
        return $this->repository->checkIndateTimesheet($checkInDate, $checkInHour, $id);
    }

    /**
     * checkout date Timesheet
     *
     * @param $timesheets
     * @param $checkOutDate
     * @param $checkOutHour
     * @param $userId
     * @return mixed
     */
    public function checkOutdateTimesheet($timesheets, $checkOutDate, $checkOutHour, $userId)
    {
        //get check_in from db
        foreach ($timesheets as $value) {
            if ($value->date == $checkOutDate) {
                $checkInHour = $value->check_in;
            }
        }
        return $this->repository->checkOutdateTimesheet($checkInHour, $checkOutDate, $checkOutHour, $userId);
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
     * @param $userID
     * @return mixed
     */
    public function getIDTimesheet($timesheetID, $userID)
    {
        try {
            return $this->repository->getIDTimesheet($timesheetID, $userID);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * get date timesheet now
     *
     * @param $dateTime
     * @param $userID
     * @return mixed
     */
    public function dateTimesheet($dateTime, $userID)
    {
        return $this->repository->dateTimesheet($dateTime, $userID);
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
    public function approval($timesheetID, $checkInReq, $checkOutReq)
    {
        $timesheets = $this->updateTimesheet($checkInReq, $checkOutReq);
        return $this->repository->approval($timesheets['actWorking'], $timesheets['paidWorking'], $timesheetID, $checkInReq, $checkOutReq);
    }

    /**
     * update many timesheets
     *
     * @param $data
     * @return void
     */
    public function approvalMany($data)
    {
        $timesheets = $this->updateTimesheet($data->check_int_request, $data->check_out_request);
        return $this->repository->approvalMany($data, $timesheets['actWorking'], $timesheets['paidWorking']);
    }
}

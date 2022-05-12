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
     * index and search date Timesheet
     * @param $request
     * @return mixed
     */
    public function searchDateTimesheet($request)
    {

        return $this->repository->searchDateTimesheet($request);
    }

    /**
     * checkin date Timesheet
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
     * @param $checkOutDate
     * @param $checkOutHour
     * @return mixed
     */
    public function checkOutdateTimesheet($checkOutDate, $checkOutHour)
    {
        return $this->repository->checkOutdateTimesheet($checkOutDate, $checkOutHour);
    }

    /**
     * create new date Timesheet after 0h
     * @param $date
     * @param $userID
     * @return mixed
     */
    public function createDate($date,$userID)
    {
        return $this->repository->createDate($date,$userID);
    }
}

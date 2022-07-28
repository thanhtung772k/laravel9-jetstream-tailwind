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
     *
     * @return mixed
     */
    public function getTimesheet();

    /**
     * Search date the repository
     *
     * @param $fromDate
     * @param $toDate
     * @param $paginate
     * @return mixed
     */
    public function searchDateTimesheet($request);

    /**
     * checkin date the repository
     *
     * @param $checkInDate
     * @param $checkInHour
     * @return mixed
     */
    public function checkIndateTimesheet($checkInDate, $checkInHour);

    /**
     * checkout date the repository
     *
     * @param $checkInHour
     * @param $checkOutDate
     * @param $checkOutHour
     * @return mixed
     */
    public function checkOutdateTimesheet($checkInHour, $checkOutDate, $checkOutHour);

    /**
     * create new date Timesheet
     *
     * @param $date
     * @param $id
     * @return mixed
     */
    public function createDate($date, $id);

    /**
     * Get timeshet by id the repository
     *
     * @param $timesheetID
     * @return mixed
     */
    public function getIDTimesheet($timesheetID);

    /**
     * get date timesheet now
     *
     * @param $dateTime
     * @return mixed
     */
    public function dateTimesheet($dateTime);

    /**
     * get date timesheet early
     *
     * @return mixed
     */
    public function dateTimesheetEarly();

    /**
     * count date timesheet
     *
     * @return mixed
     */
    public function countTimesheet();

    /**
     * approval timesheet
     *
     * @param $request
     * @param $actWorking
     * @param $paidWorking
     * @return mixed
     */
    public function approval($request, $actWorking, $paidWorking);

    /**
     * update many timesheets
     *
     * @param $data
     * @param $actWorking
     * @param $paidWorking
     * @return void
     */
    public function approvalMany($data, $actWorking, $paidWorking);
}

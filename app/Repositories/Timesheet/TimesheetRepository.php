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
     * @param $id
     * @return mixed
     */
    public function getTimesheet($id);

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
     * @param $userId
     * @return mixed
     */
    public function checkinDateTimesheet($checkInDate, $checkInHour, $userId);

    /**
     * checkout date the repository
     *
     * @param $checkInHour
     * @param $checkOutDate
     * @param $checkOutHour
     * @param $userId
     * @return mixed
     */
    public function checkoutDateTimesheet($checkInHour, $checkOutDate, $checkOutHour, $userId);

    /**
     * create new date Timesheet
     *
     * @param $date
     * @param $userId
     * @return mixed
     */
    public function createDate($date, $userId);

    /**
     * Get timeshet by id the repository
     *
     * @param $timesheetID
     * @param $userID
     * @return mixed
     */
    public function timesheetById($timesheetID, $userID);

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
     * @param $actWorking
     * @param $paidWorking
     * @param $timesheetID
     * @param $checkInReq
     * @param $checkOutReq
     * @return mixed
     */
    public function approval($actWorking, $paidWorking, $timesheetID, $checkInReq, $checkOutReq);

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

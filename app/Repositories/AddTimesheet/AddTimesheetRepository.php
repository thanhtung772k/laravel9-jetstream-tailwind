<?php

namespace App\Repositories\AddTimesheet;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface AddTimeSheetRepository.
 *
 * @package namespace App\Repositories\AddTimeSheet;
 */
interface AddTimesheetRepository extends RepositoryInterface
{
    /**
     * create Add Timesheet
     *
     * @param $request
     * @param $imageName
     * @return mixed
     */
    public function createAddTimesheet($request, $imageName);

    /**
     * get list Additional timesheet
     *
     * @param $request
     * @return mixed
     */
    public function getListAddTimesheet($request);

    /**
     * List detail Additional timesheet
     *
     * @return mixed
     */
    public function getListDetailAddTimesheet($timesheetID);

    /**
     * update Additional timesheet
     *
     * @param $id
     * @param $request
     * @param $imgEvidence
     * @return mixed
     */
    public function updateAddTimesheet($id, $request, $imgEvidence);

    /**
     * find Additional timesheet by ID
     *
     * @param $idAddTimesheet
     * @return mixed
     */
    public function findIDAddTimesheet($idAddTimesheet);

    /**
     * delete Additional timesheet
     *
     * @param $id
     * @param $evidence
     * @return mixed
     */
    public function deleteAddTimesheet($id);

    /**
     * list approval timesheet
     *
     * @param $request
     * @return mixed
     */
    public function getListApprovalTimesheet($request);

    /**
     * approval add timesheet
     *
     * @param $request
     * @param $status
     * @return void
     */
    public function updateTimesheet($request, $status);

    /**
     * update many add timesheet
     *
     * @param $request
     * @param $param
     * @return void
     */
    public function updateManyTimesheet($request, $param);
}

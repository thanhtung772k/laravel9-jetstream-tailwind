<?php

namespace App\Repositories\AddTimesheet;

use App\Enums\Constant;
use App\Enums\DBConstant;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AddTimesheet\AddTimesheetRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\AddTimesheet;

/**
 * Class AddTimesheetRepositoryEloquent.
 *
 * @package namespace App\Repositories\AddTimesheet;
 */
class AddTimesheetRepositoryEloquent extends BaseRepository implements AddTimesheetRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AddTimesheet::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * create Add Timesheet
     * @param $request
     * @return mixed
     */
    public function createAddTimesheet($request, $imageName)
    {
        return $this->model->firstOrCreate(
            [
                'timesheet_id' => $request->timesheet_id
            ],
            [
                'timesheet_id' => $request->timesheet_id,
                'admin_id' => $request->adminID,
                'check_in_real' => $request->checkinReal,
                'check_out_real' => $request->checkoutReal,
                'check_int_request' => $request->checkinRequest,
                'check_out_request' => $request->checkoutRequest,
                'evidence' => $imageName,
                'description' => $request->reason
            ]);
    }

    /**
     * get list Additional timesheet
     * @return mixed|void
     */
    public function getListAddTimesheet()
    {
        $userID = Auth::id();
        return $this->model->join('timesheets', 'add_timesheets.timesheet_id', '=', 'timesheets.id')
            ->join('users', 'add_timesheets.admin_id', '=', 'users.id')
            ->where('timesheets.user_id', $userID)->select('add_timesheets.*', 'timesheets.date', 'users.name')->get();
    }

    /**
     * List detail Additional timesheet
     * @return mixed|void
     */
    public function getListDetailAddTimesheet($timesheetID)
    {
        return $this->model->join('timesheets', 'add_timesheets.timesheet_id', '=', 'timesheets.id')
            ->join('users', 'add_timesheets.admin_id', '=', 'users.id')
            ->select('add_timesheets.*', 'timesheets.date', 'timesheets.check_in', 'timesheets.check_out', 'users.name')->find($timesheetID);
    }

    /**
     * update Additional timesheet
     * @param $addTimeID
     * @param $request
     * @param $imgEvidence
     * @return mixed
     */
    public function updateAddTimesheet($addTimeID, $request, $imgEvidence)
    {
        return $this->model->updateOrCreate(
            [
                'timesheet_id' => $request->timesheet_id,
            ],
            [
                'admin_id' => $request->adminID,
                'check_in_real' => $request->checkinReal,
                'check_out_real' => $request->checkoutReal,
                'check_int_request' => $request->checkinRequest,
                'check_out_request' => $request->checkoutRequest,
                'evidence' => $imgEvidence,
                'description' => $request->reason,
            ]);
    }

    /**
     * find Additional timesheet by ID
     * @param $addTimeID
     * @return mixed
     */
    public function findIDAddTimesheet($addTimeID)
    {
        return $this->model->find($addTimeID);
    }

    /**
     * delete Additional timesheet
     * @param $addTimeID
     * @param $evidence
     * @return mixed
     */
    public function deleteAddTimesheet($addTimeID)
    {
        return $this->model->find($addTimeID)->delete();
    }

    /**
     * list approval timsheet
     * @return void
     */
    public function getListApprovalTimesheet()
    {
        $userID = Auth::id();
        return $this->model->with('user')->join('timesheets', 'add_timesheets.timesheet_id', '=', 'timesheets.id')
            ->join('users', 'add_timesheets.admin_id', '=', 'users.id')
            ->where('add_timesheets.admin_id', $userID)->select('add_timesheets.*', 'timesheets.date', 'users.name','timesheets.user_id')->get();
    }
}

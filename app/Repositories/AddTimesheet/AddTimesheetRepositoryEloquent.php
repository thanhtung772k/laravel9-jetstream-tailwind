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
     * @param $request
     * @return mixed|void
     */
    public function getListAddTimesheet($request)
    {
        $fromDate = now()->startOfMonth()->format("Y-m-d");
        $toDate = now()->endOfMonth()->format("Y-m-d");
        if (isset($request->fromDate) && isset($request->toDate)) {
            $fromDate = $request->fromDate;
            $toDate = $request->toDate;
        } elseif ($request->fromDate) {
            $fromDate = $request->fromDate;
            $toDate = now()->endOfMonth()->format("Y-m-d");
        }
        $userID = Auth::id();
        return $this->model->join('timesheets', 'add_timesheets.timesheet_id', '=', 'timesheets.id')
            ->join('users', 'add_timesheets.admin_id', '=', 'users.id')
            ->where('timesheets.date', '>=', $fromDate)->where('timesheets.date', '<=', $toDate)
            ->where('timesheets.user_id', $userID)->select('add_timesheets.*', 'timesheets.date', 'users.name')->get();
    }

    /**
     * List detail Additional timesheet
     * @param $timesheetID
     * @return mixed
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
     * @param $request
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function getListApprovalTimesheet($request)
    {
        $fromDate = now()->startOfMonth()->format("Y-m-d");
        $toDate = now()->endOfMonth()->format("Y-m-d");
        if (isset($request->fromDate) && isset($request->toDate)) {
            $fromDate = $request->fromDate;
            $toDate = $request->toDate;
        } elseif ($request->fromDate) {
            $fromDate = $request->fromDate;
            $toDate = now()->endOfMonth()->format("Y-m-d");
        }
        $userID = Auth::id();
        return $this->model->with('user')->join('timesheets', 'add_timesheets.timesheet_id', '=', 'timesheets.id')
            ->join('users', 'add_timesheets.admin_id', '=', 'users.id')
            ->where('status', config('constant.status_wait'))
            ->where('add_timesheets.admin_id', $userID)->select('add_timesheets.*', 'timesheets.date', 'users.name', 'timesheets.user_id')
            ->where('add_timesheets.created_at', '>=', $fromDate)->where('add_timesheets.created_at', '<=', $toDate)
            ->where('timesheets.user_id','like','%'.$request->idName.'%')->get();
    }

    /**
     * approval add timesheet
     * @param $request
     * @param $status
     * @return void
     */
    public function updateAdd($request, $status)
    {
        return $this->model->where('timesheet_id', $request->timesheetID)->update([
            'status' => $status,
            'note' => $request->note
        ]);
    }

    /**
     * update many add timesheet
     * @param $request
     * @param $param
     * @return void
     */
    public function updateMany($request, $param)
    {
        return $this->model->whereIn('id', $request->addTimeId)->update([
            'note' => $request->note,
            'status' => $param
        ]);
    }
}

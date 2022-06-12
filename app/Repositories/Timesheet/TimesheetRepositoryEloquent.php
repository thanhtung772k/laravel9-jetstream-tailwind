<?php

namespace App\Repositories\Timesheet;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Timesheet\TimesheetRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Timesheet;
use App\Traits\HandleDay;

/**
 * Class TimeSheetRepositoryEloquent.
 *
 * @package namespace App\Repositories\TimeSheet;
 */
class TimesheetRepositoryEloquent extends BaseRepository implements TimesheetRepository
{
    use HandleDay;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Timesheet::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Index the repository
     */
    public function getTimesheet()
    {
        $userID = Auth::id();
        return $this->model->where('user_id', $userID)->paginate(config('constant.pagination_records'));
    }

    /**
     * Search date the repository
     * @param $request
     * @return string
     */
    public function searchDateTimesheet($request)
    {
        $fromDate = now()->startOfMonth()->format("Y-m-d");
        $toDate = now()->endOfMonth()->format("Y-m-d");
        $paginate = $request->paginate ? $request->paginate : config('constant.pagination_records');
        if (isset($request->fromDate) && isset($request->toDate) && isset($request->paginate)) {
            $fromDate = $request->fromDate;
            $toDate = $request->toDate;
        } elseif ($request->fromDate && $request->paginate) {
            $fromDate = $request->fromDate;
            $toDate = now()->endOfMonth()->format("Y-m-d");
        }
        return $this->model->select()->where('date', '>=', $fromDate)->where('date', '<=', $toDate)->where('user_id', Auth::id())->paginate($paginate);
    }

    /**
     * Search date the repository
     * @param $checkInDate
     * @param $checkInHour
     * @return string
     */
    public function checkIndateTimesheet($checkInDate, $checkInHour)
    {
        return $this->model->where('date', $checkInDate)->where('user_id', Auth::id())->update([
            'check_in' => $checkInHour
        ]);
    }

    public function createDate($date, $userID)
    {
        return $this->model->firstOrCreate([
            'date' => now()->format("Y-m-d"),
            'user_id' => $userID
        ]);
    }

    /**
     * Search date the repository
     * @param $checkOutDate
     * @param $checkOutHour
     * @return string
     */
    public function checkOutdateTimesheet($checkOutDate, $checkOutHour)
    {
        $userID = Auth::id();
        $timesheets = Timesheet::select()->where('user_id', $userID)->get();
        //get check_in from db
        foreach ($timesheets as $value) {
            if ($value->date == $checkOutDate) {
                $checkInHour = $value->check_in;
            }
        }
        $getTimesheet = $this->updateTimesheet($checkInHour,$checkOutHour);
        return $this->model->where('date', $checkOutDate)->where('user_id', $userID)->update([
            'check_out' => $checkOutHour,
            'actual_working_time' => $getTimesheet['actWorking'],
            'paid_working_time' => $getTimesheet['paidWorking'],
        ]);
    }

    /**
     * Get timeshet by id the repository
     */
    public function getIDTimesheet($timesheetID)
    {
        try {
            $userID = Auth::id();
            return $this->model->where('user_id', $userID)->find($timesheetID);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    /**
     * get timesheet id
     * @param $dateTime
     * @return mixed
     */
    public function dateTimesheet($dateTime)
    {
        $userID = Auth::id();
        return $this->model->where('date', $dateTime)->where('user_id', $userID)->first();
    }

    /**
     * get date timsheet early
     * @return mixed|void
     */
    public function dateTimesheetEarly()
    {
        return $this->model->where('user_id', Auth::id())->latest()->first();
    }

    /**
     * count date timesheet
     * @return mixed
     */
    public function countTimesheet()
    {
        return $this->model->where('user_id', Auth::id())->count();
    }

    /**
     * approval timesheet
     * @param $request
     * @param $actWorking
     * @param $paidWorking
     * @return mixed
     */
    public function approval($request, $actWorking, $paidWorking)
    {
        return $this->model->find($request->timesheetID)->update([
            'check_in' => $request->checkInReq,
            'check_out' => $request->checkOutReq,
            'actual_working_time' => $actWorking,
            'paid_working_time' => $paidWorking,
        ]);
    }

    /**
     * update many timesheets
     * @param $data
     * @param $actWorking
     * @param $paidWorking
     * @return void
     */
    public function approvalMany($data, $actWorking, $paidWorking)
    {
        return $this->model->find($data->timesheet_id)->update([
            'check_in' => $data->check_int_request,
            'check_out' => $data->check_out_request,
            'actual_working_time' => $actWorking,
            'paid_working_time' => $paidWorking,
        ]);
    }
}

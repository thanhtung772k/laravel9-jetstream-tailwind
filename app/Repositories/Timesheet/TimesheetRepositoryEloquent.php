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
     *
     * @return mixed
     */
    public function getTimesheet()
    {
        return $this->model->select('*')
            ->where(
                'user_id', Auth::id()
            )->get();
    }

    /**
     * Search date the repository
     *
     * @param $request
     * @return string
     */
    public function searchDateTimesheet($request)
    {
        return $this->model->select('*')->where([
            ['date', '>=', $request->fromDate ?: now()->startOfMonth()->format("Y-m-d")],
            ['date', '<=', $request->toDate ?: now()->endOfMonth()->format("Y-m-d")],
            ['user_id', Auth::id()],
        ])->orderBy(
            'date', 'desc'
        )->paginate($request->paginate ?: config('constant.pagination_records'));
    }

    /**
     * Search date the repository
     *
     * @param $checkInDate
     * @param $checkInHour
     * @return string
     */
    public function checkIndateTimesheet($checkInDate, $checkInHour)
    {
        return $this->model->where(
            'date', $checkInDate
        )->where(
            'user_id', Auth::id()
        )->update([
            'check_in' => $checkInHour
        ]);
    }

    /**
     * create new date Timesheet
     *
     * @param $date
     * @param $id
     * @return mixed
     */
    public function createDate($date, $id)
    {
        return $this->model->firstOrCreate([
            'date' => $date,
            'user_id' => $id
        ]);
    }

    /**
     * Search date the repository
     *
     * @param $checkInHour
     * @param $checkOutDate
     * @param $checkOutHour
     * @return string
     */
    public function checkOutdateTimesheet($checkInHour, $checkOutDate, $checkOutHour)
    {
        $getTimesheet = $this->updateTimesheet($checkInHour, $checkOutHour);

        return $this->model->where(
            'date', $checkOutDate
        )->where(
            'user_id', Auth::id()
        )->update([
            'check_out' => $checkOutHour,
            'actual_working_time' => $getTimesheet['actWorking'],
            'paid_working_time' => $getTimesheet['paidWorking'],
        ]);
    }

    /**
     * Get timeshet by id the repository
     *
     * @param $timesheetID
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function getIDTimesheet($timesheetID)
    {
        try {
            $userID = Auth::id();
            return $this->model->where(
                'user_id', $userID
            )->find($timesheetID);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    /**
     * get timesheet id
     *
     * @param $dateTime
     * @return mixed
     */
    public function dateTimesheet($dateTime)
    {
        $userID = Auth::id();
        return $this->model->where(
            'date', $dateTime
        )->where(
            'user_id', $userID
        )->first();
    }

    /**
     * get date timesheet early
     *
     * @return mixed|void
     */
    public function dateTimesheetEarly()
    {
        return $this->model->where(
            'user_id', Auth::id()
        )->latest()->first();
    }

    /**
     * count date timesheet
     *
     * @return mixed
     */
    public function countTimesheet()
    {
        return $this->model->where(
            'user_id', Auth::id()
        )->count();
    }

    /**
     * approval timesheet
     *
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
     *
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

<?php

namespace App\Repositories\Timesheet;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Timesheet\TimesheetRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Timesheet;

/**
 * Class TimeSheetRepositoryEloquent.
 *
 * @package namespace App\Repositories\TimeSheet;
 */
class TimesheetRepositoryEloquent extends BaseRepository implements TimesheetRepository
{
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
        $paginate = $request->paginate ? $request->paginate : 10;
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
        $sub = now()->parse($checkOutHour)->diffInSeconds($checkInHour);
        $actualWorkingTime = gmdate("H:i:s", $sub);
        //Convert hours to seconds
        $sumIn = now()->parse(config('constant.midnight'))->diffInSeconds(now()->parse($checkInHour));
        $sumOut = now()->parse(config('constant.midnight'))->diffInSeconds(now()->parse($checkOutHour));
        //Declare value =0
        $morning = config('constant.default_number');
        $afternoon = config('constant.default_number');
        //Check in before 12h
        if ((config('constant.twelfth_PM') - $sumIn) >= config('constant.positive_integer')) {
            if ((config('constant.eight_AM') - $sumIn) > config('constant.positive_integer')) {
                $sumIn = config('constant.eight_AM');
            }
            //checkout before 12h
            if ((config('constant.twelfth_PM')) - $sumOut > config('constant.positive_integer')) {
                $morning = $sumOut - $sumIn;
            } //checkout after 12h
            else if (((config('constant.thirteem_haftpast_PM')) - $sumOut) > config('constant.positive_integer') && ((config('constant.twelfth_PM')) - $sumOut) <= config('constant.positive_integer')) {
                $sumOut = config('constant.twelfth_PM');
                $morning = $sumOut - $sumIn;
            } //checkout after 13h30
            else {
                $morning = config('constant.twelfth_PM') - $sumIn;
                $afternoon = $sumOut - (config('constant.thirteem_haftpast_PM'));
            }
        } //check in after 12h
        else {
            //checkin from 12h to 13h30
            if (((config('constant.thirteem_haftpast_PM')) - $sumIn) > config('constant.positive_integer')) {
                $sumIn = config('constant.thirteem_haftpast_PM');
            }
            //checkin after 17h30
            if (((config('constant.seventeen_haftpast_PM')) - $sumOut) < config('constant.positive_integer')) {
                $sumOut = config('constant.seventeen_haftpast_PM');
            }
            $afternoon = $sumOut - $sumIn;
        }
        // Max paid = 4h
        $sumSang = ($morning > config('constant.four_hour')) ? config('constant.four_hour') : $morning;
        $sumChieu = ($afternoon > config('constant.four_hour')) ? config('constant.four_hour') : $afternoon;
        $sum = $sumSang + $sumChieu;
        $paidWorkingTime = gmdate("H:i:s", $sum);
        if (config('constant.eight_AM') - $sumOut > config('constant.positive_integer') || (config('constant.thirteem_haftpast_PM') - $sumIn) < config('constant.positive_integer')) {
            $actualWorkingTime = null;
            $paidWorkingTime = null;
        }
        return $this->model->where('date', $checkOutDate)->where('user_id', $userID)->update([
            'check_out' => $checkOutHour,
            'actual_working_time' => $actualWorkingTime,
            'paid_working_time' => $paidWorkingTime,
        ]);
    }

    /**
     * Get timeshet by id the repository
     */
    public function getIDTimesheet($timesheetID)
    {
        $userID = Auth::id();
        return $this->model->where('user_id', $userID)->find($timesheetID);
    }

    /**
     * get timesheet id
     * @param $dateTime
     * @return mixed
     */
    public function dateTimesheet($dateTime)
    {
        $userID = Auth::id();
        return $this->model->where('date',$dateTime)->where('user_id', $userID)->first();
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
}

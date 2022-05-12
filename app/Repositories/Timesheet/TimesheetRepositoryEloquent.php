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
        $user = Auth::id();
        return $this->model->where('user_id', $user)->paginate(config('constant.pagination_records'));
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
        $paginate = $request->paginate;
        if (isset($request->fromDate) && isset($request->toDate) && isset($request->paginate)) {
            $fromDate = $request->fromDate;
            $toDate = $request->toDate;
        }
        elseif ($request->fromDate && $request->paginate) {
            $fromDate = $request->fromDate;
            $toDate = now()->endOfMonth()->format("Y-m-d");
        }
        return $this->model->select()->where('date', '>=', $fromDate)->where('date', '<=', $toDate)->where('user_id', Auth::id())->paginate(5);
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
        $user = Auth::id();
        $timesheets = Timesheet::select()->where('user_id', $user)->get();
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
        $morning = 0;
        $afternoon = 0;
        //Check in before 12h
        if ((config('constant.twelfth_PM') - $sumIn) >= 0) {
            if ((config('constant.eight_AM') - $sumIn) > 0)
                $sumIn = config('constant.eight_AM');
            //checkout before 12h
            if ((config('constant.twelfth_PM')) - $sumOut > 0) {
                $morning = $sumOut - $sumIn;
            } //checkout after 12h
            else if (((config('constant.thirteem_haftpast_PM')) - $sumOut) > 0 && ((config('constant.twelfth_PM')) - $sumOut) <= 0) {
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
            if (((config('constant.thirteem_haftpast_PM')) - $sumIn) > 0)
                $sumIn = config('constant.thirteem_haftpast_PM');
            //checkin after 17h30
            if (((config('constant.seventeen_haftpast_PM')) - $sumOut) < 0)
                $sumOut = config('constant.seventeen_haftpast_PM');
            $afternoon = $sumOut - $sumIn;
        }
        // Max paid = 4h
        $sumSang = ($morning > config('constant.four_hour')) ? config('constant.four_hour') : $morning;
        $sumChieu = ($afternoon > config('constant.four_hour')) ? config('constant.four_hour') : $afternoon;
        $sum = $sumSang + $sumChieu;
        $paidWorkingTime = gmdate("H:i:s", $sum);
        if (config('constant.eight_AM') - $sumOut > 0) {
            $actualWorkingTime = null;
            $paidWorkingTime = null;
        }
        return $this->model->where('date', $checkOutDate)->where('user_id', $user)->update([
            'check_out' => $checkOutHour,
            'actual_working_time' => $actualWorkingTime,
            'paid_working_time' => $paidWorkingTime,
        ]);
    }
}

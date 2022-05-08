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
        return $this->model->where('user_id', $user)->paginate(10);
    }

    /**
     * Search date the repository
     * @param $fromDate
     * @param $toDate
     * @return string
     */
    public function searchDateTimesheet($fromDate, $toDate)
    {
        $user = Auth::id();
        return $this->model->select()->where('date', '>=', $fromDate)->where('date', '<=', $toDate)->where('user_id', $user)->paginate(10);
    }

    /**
     * Search date the repository
     * @param $checkInDate
     * @param $checkInHour
     * @return string
     */
    public function checkIndateTimesheet($checkInDate, $checkInHour)
    {
        $user = Auth::id();
        return $this->model->where('date', $checkInDate)->where('user_id', $user)->update([
            'check_in' => $checkInHour
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
            if ($value->date == $checkOutDate)
            {
                $checkInHour = $value->check_in;
            }
        }
        $sub = \Carbon\Carbon::parse($checkOutHour)->diffInSeconds($checkInHour);
        $actualWorkingTime = gmdate("H:i:s", $sub);
        //Convert hours to seconds
        $in = explode(":", $checkInHour);
        $sumIn = $in[0] * 3600 + $in[1] * 60;
        $out = explode(":", $checkOutHour);
        $sumOut = $out[0] * 3600 + $out[1] * 60;
        //Declare value =0
        $sang = 0;
        $chieu = 0;
        //Check in before 12h
        if ((12 * 3600 - $sumIn) >= 0) {
            if((8*3600 - $sumIn) > 0)
                $sumIn= 8*3600;
            //checkout before 12h
            if((12*3600)- $sumOut > 0)
            {
                $sang = $sumOut- $sumIn;
            }
            //checkout after 12h
            else if(((13*3600+30*60) - $sumOut) > 0 && ((12*3600)- $sumOut) <= 0)
            {
                $sumOut = 12*3600;
                $sang = $sumOut- $sumIn;
            }
            //checkout after 13h30
            else
            {
                $sang = 12*3600 - $sumIn;
                $chieu = $sumOut - (13*3600+30*60);    
            }            
        }
        //check in after 12h
        else 
        {
            //checkin from 12h to 13h30
            if(((13*3600+30*60) - $sumIn) > 0) 
                $sumIn = 13*3600+30*60;
            //checkin after 17h30
            if(((17*3600+30*60) - $sumOut) < 0)
                $sumOut = 17*3600+30*60;
            $chieu = $sumOut - $sumIn;
        }
        // Max paid = 4h
        $sumSang = ($sang > 4 * 3600) ? 4 * 3600 : $sang;
        $sumChieu = ($chieu > 4 * 3600) ? 4 * 3600 : $chieu;
        $sum = $sumSang + $sumChieu;
        $paidWorkingTime = gmdate("H:i:s", $sum);
        if(8*3600 - $sumOut >0)
        {
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

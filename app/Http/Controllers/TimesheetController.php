<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Timesheet\TimesheetService;

class TimesheetController extends Controller
{
    /**
     * index end search date Timesheets
     * @param Request $request
     * @param UserRegisterService $userRegisterService
     * @return void
     */
    public function index(Request $request, TimesheetService $timesheetService)
    {
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;
        $paginateOption = config('constant.select_value');
        $data = $timesheetService->searchDateTimesheet($request);
        return view('home.dashboard', [
            'data' => $data,
            'paginate' => $paginateOption,
        ])->with(compact('fromDate', 'toDate'));
    }

    /**
     * checkin date Timesheets
     * @param Request $request
     * @param TimesheetService $timesheetService
     * @return \Illuminate\Contracts\Foundation\Application
     */
    public function checkIn(Request $request, TimesheetService $timesheetService)
    {
        $checkInDate = $request->input('checkin_date');
        $checkInHour = $request->input('checkin_hour');
        $timesheetService->checkIndateTimesheet($checkInDate, $checkInHour);
        return redirect()->back();
    }

    /**
     * checkout date Timesheets
     * @param Request $request
     * @param TimesheetService $timesheetService
     * @return \Illuminate\Contracts\Foundation\Application
     */
    public function checkOut(Request $request, TimesheetService $timesheetService)
    {
        $checkOutDate = $request->input('checkout_date');
        $checkOutHour = $request->input('checkout_hour');
        $timesheetService->checkOutdateTimesheet($checkOutDate, $checkOutHour);
        return redirect()->back();
    }
}

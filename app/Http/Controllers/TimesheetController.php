<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Timesheet\TimesheetService;

class TimesheetController extends Controller
{
    public function __construct(TimesheetService $timesheetService)
    {
        $this->timesheetService = $timesheetService;
    }

    /**
     * index end search date Timesheets
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;
        $paginateOption = config('constant.select_value');
        $data = $this->timesheetService->searchDateTimesheet($request);
        $dataIDTimesheet = $this->timesheetService->dateTimesheet(now()->format('Y-m-d'));
        $dataCount = $this->timesheetService->countTimesheet();
        return view('home.dashboard', [
            'data' => $data,
            'paginate' => $paginateOption,
        ])->with(compact('fromDate', 'toDate','dataCount'));
    }

    /**
     * checkin date Timesheets
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application
     */
    public function checkIn(Request $request)
    {
        $checkInDate = $request->input('checkin_date');
        $checkInHour = $request->input('checkin_hour');
        $this->timesheetService->checkIndateTimesheet($checkInDate, $checkInHour);
        return redirect()->back();
    }

    /**
     * checkout date Timesheets
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application
     */
    public function checkOut(Request $request)
    {
        $checkOutDate = $request->input('checkout_date');
        $checkOutHour = $request->input('checkout_hour');
        $this->timesheetService->checkOutdateTimesheet($checkOutDate, $checkOutHour);
        return redirect()->back();
    }
}

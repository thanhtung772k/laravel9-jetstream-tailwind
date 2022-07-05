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
        $disabledCheckin = $this->timesheetService->disabledCheckin();
        return view('home.dashboard', [
            'data' => $data,
            'paginate' => $paginateOption,
            'disabledCheckin' => $disabledCheckin,
        ])->with(compact('fromDate', 'toDate', 'dataCount'));
    }

    /**
     * checkin date Timesheets
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application
     */
    public function checkIn(Request $request)
    {
        try {
            $checkInDate = $request->input('checkin_date');
            $checkInHour = now()->format('H:i:s');
            $this->timesheetService->checkIndateTimesheet($checkInDate, $checkInHour);
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * checkout date Timesheets
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application
     */
    public function checkOut(Request $request)
    {
        try {
            $checkOutDate = $request->input('checkout_date');
            $checkOutHour = now()->format('H:i:s');
            $this->timesheetService->checkOutdateTimesheet($checkOutDate, $checkOutHour);
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}

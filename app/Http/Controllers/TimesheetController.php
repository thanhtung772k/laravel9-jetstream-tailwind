<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Timesheet\TimesheetService;

class TimesheetController extends Controller
{

    /**
     * get all timesheets.
     * @param UserRegisterService $userRegisterService
     * @return \Illuminate\Http\Request
     */
    public function index(TimesheetService $timesheetService)
    {
        $data = $timesheetService->getTimesheet();
        return view('home.dashboard', [
            'data' => $data
        ]);
    }

    /**
     * search date Timesheets
     * @param Request $request
     * @return void
     */
    public function search(Request $request, TimesheetService $timesheetService)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        if ($fromDate == null || $toDate == null) {
            $fromDate = now()->startOfMonth()->format("Y-m-d");
            $toDate = now()->endOfMonth()->format("Y-m-d");
        }
        $data = $timesheetService->searchDateTimesheet($fromDate, $toDate);
        return view('home.dashboard', [
            'data' => $data
        ]);
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

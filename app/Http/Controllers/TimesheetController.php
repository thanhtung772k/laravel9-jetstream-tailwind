<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Timesheet\TimesheetRepositoryEloquent;
use App\Repositories\Timesheet\TimesheetRepository;
use App\Services\Timesheet\TimesheetService;

class TimesheetController extends Controller
{
    protected $timesheetService;

    /**
     * construct function
     * @param TimesheetService $timesheetService
     */
    public function __construct(TimesheetService $timesheetService)
    {
        $this->timesheetService = $timesheetService;
    }

    /**
     * get all timesheets.
     * @return \Illuminate\Http\Request
     */
    public function index()
    {
        $data = $this->timesheetService->getTimesheet();
        return view('home.dashboard', [
            'data' => $data
        ]);
    }
}

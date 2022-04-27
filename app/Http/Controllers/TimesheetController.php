<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Timesheet\TimesheetIndexService;

class TimesheetController extends Controller
{
    /**
     * get all tabs.
     * @param  TimesheetIndexService $timesheetListService
     * @return \Illuminate\Http\Response
     */
    public function index(TimesheetIndexService $timesheetListService)
    {
        return $timesheetListService->getListTimesheet();
    }
}

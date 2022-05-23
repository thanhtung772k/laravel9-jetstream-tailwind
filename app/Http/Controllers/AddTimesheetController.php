<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimesheetRequest;
use Illuminate\Http\Request;
use App\Services\AddTimesheet\AddTimesheetService;
use App\Services\Timesheet\TimesheetService;
use App\Services\User\UserService;

class AddTimesheetController extends Controller
{
    public function __construct(TimesheetService $timesheetService, UserService $userService, AddTimesheetService $addTimesheetService)
    {
        $this->timesheetService = $timesheetService;
        $this->userService = $userService;
        $this->addTimeSheetService = $addTimesheetService;
    }

    /**
     * get id timesheet and call Users is admin
     * @param $timesheet_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function insertAddTimesheet(Request $request, $timesheetID = null)
    {
        if (isset($timesheetID)) {
            $dataID = $this->timesheetService->getIDTimesheet($request->id);
        } else {
            $dataID = $this->timesheetService->dateTimesheetEarly($request->id);
        }
        $dataUserAdmin = $this->userService->getAllUserAdmin();
        return view('home.add-timesheet.add-timesheet', [
            'dataID' => $dataID,
            'dataUserAdmin' => $dataUserAdmin
        ]);
    }

    /**
     * index list additional timesheet
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function listAddTimesheet()
    {
        $dataAddTimesheet = $this->addTimeSheetService->getListAddTimesheet();
        return view('home.add-timesheet.add-timesheet-list-dashboard', [
            'dataAddTimesheet' => $dataAddTimesheet
        ]);
    }

    /**
     * create additional timesheet
     * @param TimesheetRequest $request
     * @return void
     */
    public function addTimeSheet(TimesheetRequest $request)
    {
        $this->addTimeSheetService->createAddTimesheet($request);
        return redirect()->route('get_create_addtimesheet');
    }

    /**
     * List detail Additional timesheet
     * @param $timesheetID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function listDetailAddTimesheet($timesheetID)
    {
        $dataDetailAddTimesheet = $this->addTimeSheetService->getListDetailAddTimesheet($timesheetID);
        return view('home.add-timesheet.add-timesheet-detail', [
            'dataDetailAddTimesheet' => $dataDetailAddTimesheet
        ]);
    }

    /**
     * edit Additional timesheet  "timesheet_id" => null
     * @param $timesheetID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editAddTimesheet($timesheetID)
    {
        $dataEditAddTimesheet = $this->addTimeSheetService->getListDetailAddTimesheet($timesheetID);
        $dataUserAdmin = $this->userService->getAllUserAdmin();
        return view('home.add-timesheet.add-timesheet-edit', [
            'dataEditAddTimesheet' => $dataEditAddTimesheet,
            'dataUserAdmin' => $dataUserAdmin
        ]);
    }

    /**
     * update Additional timesheet
     * @param $addTimeID
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAddTimesheet($addTimeID, Request $request)
    {
        $dateTimesheet = $this->timesheetService->dateTimesheet($request->timesheet_date);
        $addTimeId = $dateTimesheet->id;
        $this->addTimeSheetService->updateAddTimesheet($addTimeId, $request);
        return redirect()->route('get_create_addtimesheet');
    }

    /**
     * delete Additional timesheet
     * @param $addTimeID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAddTimesheet($addTimeID)
    {
        $dataByIDAddTimesheet = $this->addTimeSheetService->findIDAddTimesheet($addTimeID);
        $this->addTimeSheetService->deleteAddTimesheet($addTimeID, $dataByIDAddTimesheet->evidence);
        return redirect()->route('get_create_addtimesheet');
    }
}

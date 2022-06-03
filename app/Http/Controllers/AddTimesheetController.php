<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimesheetRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\AddTimesheet\AddTimesheetService;
use App\Services\Timesheet\TimesheetService;
use App\Services\User\UserService;
use PHPUnit\Exception;
use Illuminate\Support\Facades\DB;

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
     * @return Application|Factory|View
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
     * @return Application|Factory|View
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
        try {
            $this->addTimeSheetService->createAddTimesheet($request);
            return redirect()->route('get_create_addtimesheet');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * List detail Additional timesheet
     * @param $timesheetID
     * @return Application|Factory|View
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
     * @return Application|Factory|View
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
     * @return RedirectResponse
     */
    public function updateAddTimesheet($addTimeID, Request $request)
    {
        try {
            $dateTimesheet = $this->timesheetService->dateTimesheet($request->timesheet_date);
            $addTimeId = $dateTimesheet->id;
            $this->addTimeSheetService->updateAddTimesheet($addTimeId, $request);
            return redirect()->route('get_create_addtimesheet');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * delete Additional timesheet
     * @param $addTimeID
     * @return RedirectResponse
     */
    public function deleteAddTimesheet($addTimeID)
    {
        try {
            if (isset($addTimeID)) {
                $dataByIDAddTimesheet = $this->addTimeSheetService->findIDAddTimesheet($addTimeID);
                if (isset($dataByIDAddTimesheet->evidence)) {
                    $this->addTimeSheetService->deleteAddTimesheet($addTimeID, $dataByIDAddTimesheet->evidence);
                }
                return redirect()->route('get_create_addtimesheet');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * list add-timesheet approval
     * @return Application|Factory|View
     */
    public function approvalTimesheet()
    {
        $dataTimesheetApproval = $this->addTimeSheetService->getListApprovalTimesheet();
        $getInfUser = $this->userService->getUser();
        return view('home.add-timesheet.approval.add-timesheet-approval-dashbroad', [
            'dataTimesheetApproval' => $dataTimesheetApproval,
            'getInfUser' => $getInfUser,
        ]);
    }

    /**
     * get timesheet by id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAddtimesheetById($id)
    {
        return response()->json($this->addTimeSheetService->findIDAddTimesheet($id));
    }

    /**
     * approval Additional timesheet
     * @param Request $request
     * @param $id
     * @param $param
     * @return Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|void
     */
    public function approvalOrReject(Request $request, $id, $param = null)
    {
        DB::beginTransaction();
        try {
            if ($request->ajax()) {
                if ($param == config('constant.status_agree')) {
                    $this->addTimeSheetService->update($request, $param);
                    $this->timesheetService->approval($request);
                } elseif ($param == config('constant.status_reject')) {
                    $this->addTimeSheetService->update($request, $param);
                } else {
                    return redirect()->back();
                }
                DB::commit();
                return response([
                    'status' => true
                ]);
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * update Additional Timesheets
     * @param Request $request
     * @param $param
     * @return void
     */
    public function updateAll(Request $request, $param)
    {
        DB::beginTransaction();
        try {
            if ($param == config('constant.status_agree')) {
                $this->addTimeSheetService->updateMany($request, $param);
                foreach ($request->addTimeId as $id) {
                    $data = $this->addTimeSheetService->findIDAddTimesheet($id);
                    $this->timesheetService->approvalMany($data);
                }
            } elseif ($param == config('constant.status_reject')) {
                $this->addTimeSheetService->updateMany($request, $param);
            } else {
                return redirect()->back();
            }
            DB::commit();
            return response([
                'status' => true
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back();
        }
    }
}

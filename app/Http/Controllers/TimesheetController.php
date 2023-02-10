<?php

namespace App\Http\Controllers;

use App\Models\Timekeeping;
use App\Services\Department\DepartmentService;
use App\Services\Role\RoleService;
use Illuminate\Http\Request;
use App\Services\Timesheet\TimesheetService;
use App\Services\UserDetail\UserDetailService;
use Illuminate\Support\Facades\Auth;

class TimesheetController extends Controller
{
    public function __construct(TimesheetService $timesheetService)
    {
        $this->timesheetService = $timesheetService;
        $this->userDetailService = app(UserDetailService::class);
        $this->roleService = app(RoleService::class);
        $this->departmentService = app(DepartmentService::class);
    }

    /**
     * index end search date Timesheets
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $userID = Auth::id();
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;
        $paginateOption = config('constant.select_value');
        $data = $this->timesheetService->searchDateTimesheet($request);
        $dateNow = $this->timesheetService->dateTimesheet(now()->format('Y-m-d'), $userID);
        $dataCount = $this->timesheetService->countTimesheet();
        $disabled = $this->timesheetService->dateTimesheetEarly();
        $disabledCheckin = $dateNow ?: $disabled;
        return view('home.dashboard', [
            'data' => $data,
            'paginate' => $paginateOption,
            'disabledCheckin' => $disabledCheckin,
        ])->with(compact('fromDate', 'toDate', 'dataCount'));
    }

    /**
     * checkin date Timesheets
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application
     */
    public function checkIn(Request $request)
    {
        try {
            $id = Auth::id();
            $checkInDate = $request->input('checkin_date');
            $checkInHour = now()->format('H:i:s');
            $this->timesheetService->checkIndateTimesheet($checkInDate, $checkInHour, $id);
            Timekeeping::create([
                'employee_code' => $id,
                'date_time' => now()->format('Y-m-d H:i:s'),
                'date' => now()->format("Y-m-d")
            ]);
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * checkout date Timesheets
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application
     */
    public function checkOut(Request $request)
    {
        try {
            $userId = Auth::id();
            $checkOutDate = $request->input('checkout_date');
            $checkOutHour = now()->format('H:i:s');
            $timesheet = $this->timesheetService->getTimesheet($userId);
            $this->timesheetService->checkOutdateTimesheet($timesheet, $checkOutDate, $checkOutHour, $userId);
            Timekeeping::create([
                'employee_code' => $userId,
                'date_time' => now()->format('Y-m-d H:i:s'),
                'date' => now()->format("Y-m-d")
            ]);
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function management(Request $request) 
    {
        $departments = $this->departmentService->getDepartment();
        $location = $this->roleService->getLocation();
        $users = $this->userDetailService->getAll($request);
        return view('home.admin.management-dashbroad', [
            'users' => $users,
            'departments' => $departments,
            'location' => $location,
        ]);
    }

    public function timesheetUser(Request $request, $id)
    {
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;
        $paginateOption = config('constant.select_value');
        $data = $this->timesheetService->searchDateTimesheetUser($request, $id);
        $dateNow = $this->timesheetService->dateTimesheet(now()->format('Y-m-d'), $id);
        $dataCount = $this->timesheetService->countTimesheet();
        $disabled = $this->timesheetService->dateTimesheetEarly();
        $disabledCheckin = $dateNow ?: $disabled;
        $userById = $this->userDetailService->userById($id);
        $total = 0;
        foreach ($data as $value) {
            $weekend = now()->parse($value->date)->isWeekend();
            if (!$weekend) {
                $total += $value->paid_work_day;
            }
        }
        return view('home.admin.timesheet-user-dashbroad', [
            'data' => $data,
            'paginate' => $paginateOption,
            'disabledCheckin' => $disabledCheckin,
            'userById' => $userById,
        ])->with(compact('fromDate', 'toDate', 'dataCount', 'total'));
    }

    public function history(Request $request)
    {
        $timeKeeping = Timekeeping::where([
            ['employee_code' , $request->id],
            ['date' , $request->date]
        ])->get();
        return response()->json($timeKeeping);
    }
}

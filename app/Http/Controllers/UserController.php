<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Http\Requests\UserRequest;
use App\Jobs\SendMailUser;
use App\Mail\SendMail;
use App\Mail\SendMailPassword;
use App\Services\Department\DepartmentService;
use App\Services\Position\PositionService;
use App\Services\Role\RoleService;
use App\Services\Timesheet\TimesheetService;
use App\Services\User\UserService;
use App\Services\UserDetail\UserDetailService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        $this->userService = app(UserService::class);
        $this->roleService = app(RoleService::class);
        $this->departmentService = app(DepartmentService::class);
        $this->positionService = app(PositionService::class);
        $this->userDetailService = app(UserDetailService::class);
        $this->timesheetService = app(TimesheetService::class);
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $positions = $this->positionService->getAll();
        $departments = $this->departmentService->getDepartment();
        $roles = $this->roleService->getLocation();
        return view('home.user.create', [
            'positions' => $positions,
            'departments' => $departments,
            'roles' => $roles,
        ]);
    }

    /**
     * insert a new user created resource in storage.
     *
     * @param UserRequest $request
     * @return void
     */
    public function insert(UserRequest $request)
    {
        DB::beginTransaction();
        try {
            $random = Str::random(8);
            $passDefault = Hash::make($random);
            $this->userService->insert($request, $passDefault);
            $userId = $this->userService->getLast();
            $this->userDetailService->insert($request, $userId->id);
            $start = now()->parse(now())->startOfMonth();
            $end = now();
            $dates = [];
            $i = config('constant.VALUE_DEFAULT_NEGATIVE_ONE');

            while ($start->lte($end)) {
                $i++;
                $dates[] = $start->copy();
                $start->addDay();
                $this->timesheetService->createDate(now()->parse($dates[$i])->format("Y-m-d"), $userId->id);
            }

            $details = [
                'email' => $request->email,
                'name' => $request->name,
                'random' => $random,
            ];

            Mail::to($request->email)->send(new SendMailPassword($details));
            DB::commit();
            return redirect()->route('index_user');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors();
        }
    }

    /**
     * Show all users
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $departments = $this->departmentService->getDepartment();
        $location = $this->roleService->getLocation();
        $users = $this->userDetailService->getAll($request);
        return view('home.user.dashbroad', [
            'users' => $users,
            'departments' => $departments,
            'location' => $location,
        ]);
    }

    /**
     * Show the form for editing user by ID
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $positions = $this->positionService->getAll();
        $departments = $this->departmentService->getDepartment();
        $roles = $this->roleService->getLocation();
        $userById = $this->userDetailService->userById($id);
        return view('home.user.edit', [
            'positions' => $positions,
            'departments' => $departments,
            'roles' => $roles,
            'userById' => $userById,
        ]);
    }

    /**
     * Update user by id resource in storage.
     *
     * @param UserRequest $request
     * @param int $id
     * @return string
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->userDetailService->update($request, $id);
            $this->userService->updateUser($request, $id);
            DB::commit();
            return redirect()->route('index_user');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors();
        }
    }

    /**
     * Delete user by id resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        try {
            $this->userDetailService->delete($id);
            $this->userService->deleteUser($id);
            return redirect()->back();
        } catch (\Exception $exception) {
            return redirect()->back()->withInput()->withErrors();
        }
    }

    /**
     * Show all users leave
     *
     * @param Request $request
     * @return void
     */
    public function leave(Request $request)
    {
        $departments = $this->departmentService->getDepartment();
        $location = $this->roleService->getLocation();
        $users = $this->userDetailService->userLeave($request);
        return view('home.user.dashbroad_user_leave', [
            'users' => $users,
            'departments' => $departments,
            'location' => $location,
        ]);
    }

    /**
     * Show detail user
     *
     * @param int $id
     * @return void
     */
    public function detail($id)
    {
        $user = $this->userDetailService->detail($id);
        return view('home.user.detail', [
            'user' => $user,
        ]);
    }
}

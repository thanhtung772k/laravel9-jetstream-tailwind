<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\Services\UserHasProject\UserHasProjectService;
use App\Services\Role\RoleService;
use App\Services\Project\ProjectService;
use App\Services\ProjectType\ProjectTypeService;
use App\Services\Department\DepartmentService;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function __construct(UserService $userService, RoleService $roleService, ProjectService $projectService, ProjectTypeService $projectTypeService, UserHasProjectService $userHasProjectService, DepartmentService $departmentService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
        $this->projectService = $projectService;
        $this->projectTypeService = $projectTypeService;
        $this->userHasProjectService = $userHasProjectService;
        $this->departmentService = $departmentService;
    }

    /**
     * Index and search Project
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        //dd($request->all());
        $getProject = $this->projectService->getProject($request);
        $getProjectType = $this->projectTypeService->getProjectType();
        $getDepartment = $this->departmentService->getDepartment();
        return view('home.add-project.dashboard', [
            'getProject' => $getProject,
            'getProjectType' => $getProjectType,
            'getDepartment' => $getDepartment
        ]);
    }

    /**
     * Create new project
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function insert()
    {
        $getLocation = $this->roleService->getLocation();
        $getUsers = $this->userService->getAllUser();
        $getProjectType = $this->projectTypeService->getProjectType();
        $getDepartment = $this->departmentService->getDepartment();
        return view('home.add-project.create-project', [
            'getLocation' => $getLocation,
            'getUsers' => $getUsers,
            'getProjectType' => $getProjectType,
            'getDepartment' => $getDepartment,
        ]);
    }

    /**
     * Create new project
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(ProjectRequest $request)
    {
        DB::beginTransaction();
        $this->projectService->createProject($request);
        try {
            $getLastproject = $this->projectService->getLastproject();
            $this->userHasProjectService->createUserHasProject($request, $getLastproject->id);
            DB::commit();
            return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function edit()
    {
        $getLocation = $this->roleService->getLocation();
        $getUsers = $this->userService->getAllUser();
        $getProjectType = $this->projectTypeService->getProjectType();
        $getDepartment = $this->departmentService->getDepartment();
        return view('home.add-project.edit-project', [
            'getLocation' => $getLocation,
            'getUsers' => $getUsers,
            'getProjectType' => $getProjectType,
            'getDepartment' => $getDepartment,
        ]);
    }

    /**
     * Delete project
     * @param $idPrj
     * @return void
     */
    public function deletePrj($idPrj)
    {
        try {
            $this->projectService->deleteProject($idPrj);
            $this->userHasProjectService->deleteUserHasProject($idPrj);
            return redirect()->back();
        } catch (\Exception $exception) {
            return redirect()->back();
        }
    }
}

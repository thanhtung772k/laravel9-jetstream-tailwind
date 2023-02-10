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
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $projects = $this->projectService->getProject($request);
        $projectTypes = $this->projectTypeService->getProjectType();
        $departments = $this->departmentService->getDepartment();
        return view('home.add-project.dashboard', [
            'projects' => $projects,
            'projectTypes' => $projectTypes,
            'departments' => $departments
        ]);
    }

    /**
     * Create new project
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function insert()
    {
        $locations = $this->roleService->getLocation();
        $users = $this->userService->getAllUser();
        $projectTypes = $this->projectTypeService->getProjectType();
        $departments = $this->departmentService->getDepartment();

        return view('home.add-project.create-project', [
            'locations' => $locations,
            'users' => $users,
            'projectTypes' => $projectTypes,
            'departments' => $departments,
        ]);
    }

    /**
     * Create new project
     *
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
            return redirect()->route('get_project');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect();
        }
    }

    /**
     * view edit project
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $locations = $this->roleService->getLocation();
        $users = $this->userService->getAllUser();
        $projectTypes = $this->projectTypeService->getProjectType();
        $departments = $this->departmentService->getDepartment();
        $projectById = $this->projectService->getProjectById($id);
        $userProjects = $this->userHasProjectService->getUserHasPrjById($id);

        return view('home.add-project.edit-project', [
            'locations' => $locations,
            'users' => $users,
            'projectTypes' => $projectTypes,
            'departments' => $departments,
            'projectById' => $projectById,
            'userProjects' => $userProjects,
        ]);
    }

    /**
     * update Project
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProjectRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->userHasProjectService->deleteUserHasProject($request, $id);
            $this->projectService->updateProject($request, $id);
            $this->userHasProjectService->update($request, $id);
            $this->userHasProjectService->createOrUpdate($request, $id);
            DB::commit();
            return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * Delete project
     *
     * @param Request $request
     * @param $id
     * @return void
     */
    public function deletePrj(Request $request, $id)
    {
        try {
            $this->projectService->deleteProject($id);
            $this->userHasProjectService->deleteUserHasProject($request, $id);

            return redirect()->back();
        } catch (\Exception $exception) {
            return redirect()->back();
        }
    }

    /**
     * Detail project
     *
     * @param $id
     * @return void
     */
    public function detail($id)
    {
        $project = $this->projectService->detail($id);
        $userProjects = $this->userHasProjectService->detail($id);
        return view('home.add-project.detail-project', [
            'project' => $project,
            'userProjects' => $userProjects,
        ]);
    }

    /**
     * Chart user status: free or working
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function chartStatus()
    {
        $title = [__('lang.free'), __('lang.working')];
        $userWorking = $this->userHasProjectService->working();
        $userFrees = $this->userService->free($userWorking);
        $dataUser= [count($userFrees), count($userWorking)];
        return view('home.user.chart_user_status', [
            'title' => json_encode($title),
            'dataUser' => json_encode($dataUser),
        ]);
    }
}

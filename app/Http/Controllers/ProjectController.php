<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\Services\Role\RoleService;

class ProjectController extends Controller
{
    public function __construct(UserService $userService, RoleService $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('home.add-project.dashboard');
        //return view('home.add-project.create-project');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function insert()
    {
        $getLocation = $this->roleService->getLocation();
        return view('home.add-project.create-project', [
            'getLocation' => $getLocation,
        ]);
    }
}

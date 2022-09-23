<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\CommentRequest;
use App\Services\Category\CategoryService;
use App\Services\Comment\CommentService;
use App\Services\UserDetail\UserDetailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->commentService = app(CommentService::class);
        $this->userDetailService = app(UserDetailService::class);
        $this->categoryService = app(CategoryService::class);
    }

    /**
     * comment post user
     *
     * @param CommentRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function comment(CommentRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->commentService->create($request);
            DB::commit();
            return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors();
        }
    }
}

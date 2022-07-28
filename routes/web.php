<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\CommandController;
use App\Http\Controllers\AddTimesheetController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    // ........................ route home .............................
    Route::get('/home', [TimesheetController::class, 'index'])->name('dashboard');
    Route::post('/home-checkin', [TimesheetController::class, 'checkIn'])->name('check_in');
    Route::post('/home-checkout', [TimesheetController::class, 'checkOut'])->name('check_out');
    // ........................ route additional timesheet ........................
    Route::get('/additional-timesheet-create/{id?}', [AddTimesheetController::class, 'insertAddTimesheet'])->name('get_addtimesheet');
    Route::post('/additional-timesheet-list', [AddTimesheetController::class, 'addTimeSheet'])->name('create_addtimesheet');
    Route::get('/additional-timesheet', [AddTimesheetController::class, 'listAddTimesheet'])->name('get_create_addtimesheet');
    Route::get('/additional-timesheet-detail/{addTimeID}', [AddTimesheetController::class, 'listDetailAddTimesheet'])->name('detail_addtimesheet');
    Route::get('/additional-timesheet-edit/{addTimeID}', [AddTimesheetController::class, 'editAddTimesheet'])->name('edit_addtimesheet');
    Route::post('/additional-timesheet-edit/{addTimeID}', [AddTimesheetController::class, 'updateAddTimesheet'])->name('update_addtimesheet');
    Route::get('/additional-timesheet-delete/{addTimeID}', [AddTimesheetController::class, 'deleteAddTimesheet'])->name('delete_addtimesheet');
    Route::get('/additional-timesheet-approval', [AddTimesheetController::class, 'approvalTimesheet'])->name('addtimesheet_approval');
    Route::get('/additional-timesheet-approval/{id}', [AddTimesheetController::class, 'getAddtimesheetById']);
    Route::put('/additional-timesheet-approval/{id}/{param?}', [AddTimesheetController::class, 'approvalOrReject']);
    Route::put('/additional-timesheet-approvalAll/{param?}', [AddTimesheetController::class, 'updateAll'])->name('updateAll');
    // ........................ route additional project ........................
    Route::get('/additional-project-list', [ProjectController::class, 'index'])->name('get_project');
    Route::get('/additional-project-create', [ProjectController::class, 'insert'])->name('create_project');
    Route::post('/additional-project-add', [ProjectController::class, 'create'])->name('add_project');
    Route::get('/additional-project-edit/{projID}', [ProjectController::class, 'edit'])->name('edit_project');
    Route::get('/additional-project-detail/{projID}', [ProjectController::class, 'detail'])->name('detail_project');
    Route::post('/additional-project-update/{projID}', [ProjectController::class, 'update'])->name('update_project');
    Route::get('/additional-project-delete/{projID}', [ProjectController::class, 'deletePrj'])->name('delete_project');
    // ........................ route user management ........................
    Route::get('/management-user-create', [UserController::class, 'create'])->name('create_user');
    Route::post('/management-user-create', [UserController::class, 'insert'])->name('insert_user');
    Route::get('/management-user-index', [UserController::class, 'index'])->name('index_user');
    Route::get('/management-user-edit/{id}', [UserController::class, 'edit'])->name('edit_user');
    Route::post('/management-user-update/{id}', [UserController::class, 'update'])->name('update_user');
    Route::get('/management-user-delete/{id}', [UserController::class, 'delete'])->name('delete_user');
    Route::get('/management-user-leave', [UserController::class, 'leave'])->name('leave_user');
    Route::get('/management-user-detail/{id}', [UserController::class, 'detail'])->name('detail_user');
});
Route::get('batch_01', [CommandController::class, 'insert'])->name('batch_01');
Route::get('/test', function () {
    $arr = [3, 6, 5, 1, 2];
    for ($i = 0; $i < (count($arr) - 1); $i++)
        for ($j = $i + 1; $j < count($arr); $j++) {
            if ($arr[$i] > $arr[$j]) {
                $tam = $arr[$j];
                $arr[$j] = $arr[$i];
                $arr[$i] = $tam;
            }
        }
        return $arr;
    });



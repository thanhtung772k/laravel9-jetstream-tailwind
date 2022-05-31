<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\CommandController;
use App\Http\Controllers\AddTimesheetController;

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
    return view('welcome');
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
    // ........................ route over time ........................
    Route::get('/additional-timesheet-create/{id?}', [AddTimesheetController::class, 'insertAddTimesheet'])->name('get_addtimesheet');
    Route::post('/additional-timesheet-list', [AddTimesheetController::class, 'addTimeSheet'])->name('create_addtimesheet');
    Route::get('/additional-timesheet', [AddTimesheetController::class, 'listAddTimesheet'])->name('get_create_addtimesheet');
    Route::get('/additional-timesheet-detail/{addTimeID}', [AddTimesheetController::class,'listDetailAddTimesheet'])->name('detail_addtimesheet');
    Route::get('/additional-timesheet-edit/{addTimeID}', [AddTimesheetController::class,'editAddTimesheet'])->name('edit_addtimesheet');
    Route::post('/additional-timesheet-edit/{addTimeID}', [AddTimesheetController::class,'updateAddTimesheet'])->name('update_addtimesheet');
    Route::get('/additional-timesheet-delete/{addTimeID}', [AddTimesheetController::class, 'deleteAddTimesheet'])->name('delete_addtimesheet');
    Route::get('/additional-timesheet-approval', [AddTimesheetController::class, 'approvalTimesheet'])->name('addtimesheet_approval');
    Route::get('/additional-timesheet-approval/{id}', [AddTimesheetController::class, 'getAddtimesheetById']);
    Route::put('/additional-timesheet-approval/{id}/{param?}', [AddTimesheetController::class, 'approvalOrReject']);
    Route::put('/additional-timesheet-approvalAll', [AddTimesheetController::class, 'updateAll']);
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



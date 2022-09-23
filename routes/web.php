<?php

use App\Http\Controllers\Client\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\CommandController;
use App\Http\Controllers\AddTimesheetController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Livewire\HomeComponent;


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

Route::get('/', function (){
    return view('client.layouts.home');
})->name('client.index');
Route::get('/detail/{slug}', function (){
    return view('client.layouts.detail');
})->name('client.detail_post');
Route::get('/category/{slug}', [HomeController::class, 'category'])->name('client.category_post');
Route::post('/comment-post-create', [CommentController::class, 'comment'])->name('client.comment');

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
    Route::get('/management-user-chart', [ProjectController::class, 'chartStatus'])->name('chart_status');
    // ........................ route user management ........................
    Route::get('/management-user-create', [UserController::class, 'create'])->name('create_user');
    Route::post('/management-user-create', [UserController::class, 'insert'])->name('insert_user');
    Route::get('/management-user-index', [UserController::class, 'index'])->name('index_user');
    Route::get('/management-user-edit/{id}', [UserController::class, 'edit'])->name('edit_user');
    Route::post('/management-user-update/{id}', [UserController::class, 'update'])->name('update_user');
    Route::get('/management-user-delete/{id}', [UserController::class, 'delete'])->name('delete_user');
    Route::get('/management-user-leave', [UserController::class, 'leave'])->name('leave_user');
    Route::get('/management-user-detail/{id}', [UserController::class, 'detail'])->name('detail_user');
    // ........................ route user management ........................
    Route::get('/management-post-index', [PostController::class, 'index'])->name('index_post');
    Route::get('/management-post-create', [PostController::class, 'create'])->name('create_post');
    Route::post('/management-post-create', [PostController::class, 'insert'])->name('insert_post');
    Route::get('/management-post-edit/{id}', [PostController::class, 'edit'])->name('edit_post');
    Route::post('/management-post-edit/{id}', [PostController::class, 'update'])->name('update_post');
    Route::get('/management-post-delete/{id}', [PostController::class, 'delete'])->name('delete_post');
    Route::get('/management-post-detail/{id}', [PostController::class, 'detail'])->name('detail_post');
    Route::post('/management-post-uploadImage', [PostController::class, 'uploadImage'])->name('ckeditor.upload');
    // ........................ Comment ........................

});
Route::get('batch_01', App\Http\Livewire\User\UserIndex::class)->name('batch_01');
Route::get('/test', function () {
    $x = 4;
    $y = 4;
    $sum = (2 * 2 + 4 * 2 + 2 * 2 + 2.5 * 2 + 3.5 * 4 + 4 * 3 + 3 * 2 + 2 * 3 + 3 * 2 + 1.5 * 3 + 3 * 3 + 3 * 2 + 3.5 * 2 + 4 * 2 + 3.5 * 2 + 3 * 2 + 4 * 2 + 2 * 2 + 3.5 * 2 + 4 * 2 + 2 * 3 + 3 * 2 + 4 * 2 + 4 * 2 + 3 * 2 + 4 * 2 + 3 * 3 + 3 * 2 + 4 * 2 + 2.5 * 2 + 4 * 2 + 3 * 2 + 3.5 * 2 + 4 + 3 * 3 + 4 * 3 + 3.5 * 2 + 4 * 3 + 4 * 2 + 4 * 2 + 3.5 + 4 * 2 + 3.5 * 3 + 3 * 2 + 4 * 2 + 3.5 * 3 + 4 * 2 + 4 * 2 + 4 * 2 + 4 * 2 + 3.5 * 2 + 4 * 4 * 3 + $x * 5 + $y * 14) / 144;
    $sumTung = (12 + 14 + 4 + 5 + 8 + 6 + 8 + 7 + 12 + 2 + 7.5 + 5 + 9 + 7 + 7 + 6 + 4 + 8 + 4 + 8 + 5 + 8 + 10.5 + 8 + 6 + 8 + 4 + 7 + 7 + 7 + 8 + 8 + 12 + 3 + 6 + 9 + 8 + 6 + 10.5 + 7 + 4 + 8 + 5 + 12 + 7 + 7 + 7 + 6 + 6 + 7.5 + 4 + 14 + 14 + 14 + $x * 5 + $y * 14) / 144;
    return $sum;
});



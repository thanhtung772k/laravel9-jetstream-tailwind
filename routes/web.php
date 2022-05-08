<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimesheetController;

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
//    Route::get('/dashboard', function () {
//        return view('home.dashboard');
//    })->name('dashboard');
    // ........................ route home ........................
    Route::get('/home', [TimesheetController::class,'index'])->name('dashboard');
    Route::post('/home', [TimesheetController::class,'search']);
    Route::post('/home-checkin',[TimesheetController::class,'checkIn'])->name('check_in');
    Route::post('/home-checkout',[TimesheetController::class,'checkOut'])->name('check_out');
});

Route::get('/test',function (){
    $a= gmdate('H:i:s', 7200);
    return $a;
});

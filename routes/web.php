<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParkingActivitieController;
use App\Http\Controllers\ParkingAttendanceController;
use App\Http\Controllers\ParkingComplaintController;
use App\Http\Controllers\ParkingSlotController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserVehicleController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('isLogged')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

   
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/register', [UserController::class, 'register_action']);
    Route::get('/reload-captcha', [UserController::class, 'reloadCaptcha']);
    
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'login_action']);
});

Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');


Route::middleware('AuthCheck')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', ["listtitle" => "Dashboard"]);
    });
    Route::get('/users/index', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.index.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/dashboard', [DashboardController::class, 'getTotal'])->name('getTotal');
   


    Route::get('/parkingslots/index', [ParkingSlotController::class, 'index'])->name('parkingslots.index');
    Route::get('/parkingslots/create', [ParkingSlotController::class, 'create'])->name('parkingslots.create');
    Route::post('/parkingslots/store', [ParkingSlotController::class, 'store'])->name('parkingslots.store');
    Route::get('/parkingslots/{parkingslot}/edit', [ParkingSlotController::class, 'edit'])->name('parkingslots.edit');
    Route::put('/parkingslots/{parkingslot}', [ParkingSlotController::class, 'update'])->name('parkingslots.update');
    Route::delete('/parkingslots/{parkingslot}', [ParkingSlotController::class, 'destroy'])->name('parkingslots.destroy');


    Route::get('/parkingactivities/index', [ParkingActivitieController::class, 'index'])->name('parkingactivities.index');
    Route::get('/parkingactivities/index1', [ParkingActivitieController::class, 'index1'])->name('parkingactivities.index1');
    Route::get('/parkingactivities/pdf_parkingactivitie', [ParkingActivitieController::class, 'cetak_pdf'])->name('parkingactivities.cetak_pdf');
    Route::get('/parkingactivities/create', [ParkingActivitieController::class, 'create'])->name('parkingactivities.create');
    Route::post('/parkingactivities/store', [ParkingActivitieController::class, 'store'])->name('parkingactivities.store');
    Route::get('/parkingactivities/{parkingactivity}/edit', [ParkingActivitieController::class, 'edit'])->name('parkingactivities.edit');
    Route::put('/parkingactivities/{parkingactivity}', [ParkingActivitieController::class, 'update'])->name('parkingactivities.update');
    Route::delete('/parkingactivities/{parkingactivity}', [ParkingActivitieController::class, 'destroy'])->name('parkingactivities.destroy');
    // Route::get('/dashboard', [ParkingActivitieController::class, 'getTotalActivities'])->name('getTotalActivities');

    Route::get('/parkingcomplaints/index', [ParkingComplaintController::class, 'index'])->name('parkingcomplaints.index');
    Route::get('/parkingcomplaints/create', [ParkingComplaintController::class, 'create'])->name('parkingcomplaints.create');
    Route::post('/parkingcomplaints/store', [ParkingComplaintController::class, 'store'])->name('parkingcomplaints.store');
    Route::get('/parkingcomplaints/{parkingcomplaint}/edit', [ParkingComplaintController::class, 'edit'])->name('parkingcomplaints.edit');
    Route::put('/parkingcomplaints/{parkingcomplaint}', [ParkingComplaintController::class, 'update'])->name('parkingcomplaints.update');
    Route::delete('/parkingcomplaints/{parkingcomplaint}', [ParkingComplaintController::class, 'destroy'])->name('parkingcomplaints.destroy');


    Route::get('/parkingattendances/index', [ParkingAttendanceController::class, 'index'])->name('parkingattendances.index');
    Route::get('/parkingattendances/create', [ParkingAttendanceController::class, 'create'])->name('parkingattendances.create');
    Route::post('/parkingattendances/store', [ParkingAttendanceController::class, 'store'])->name('parkingattendances.store');
    Route::get('/parkingattendances/{parkingattendance}/edit', [ParkingAttendanceController::class, 'edit'])->name('parkingattendances.edit');
    Route::put('/parkingattendances/{parkingattendance}', [ParkingAttendanceController::class, 'update'])->name('parkingattendances.update');
    Route::delete('/parkingattendances/{parkingattendance}', [ParkingAttendanceController::class, 'destroy'])->name('parkingattendances.destroy');

    // Route::get('/vehicles/index', [UserVehicleController::class, 'index'])->name('vehicles.index');
    Route::get('/vehicles/index', [UserVehicleController::class, 'index'])->name('vehicles.index');
    Route::get('/vehicles/create', [UserVehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles/store', [UserVehicleController::class, 'store'])->name('vehicles.store');
});



// Route::delete('/parkingslots/{parkingslot}', [ParkingSlotController::class, 'destroy'])->name('parkingslots.destroy');
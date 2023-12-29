<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ParkingSlotController;
use App\Http\Controllers\API\ParkingActivitieController;
use App\Http\Controllers\API\ParkingComplaintController;
use App\Http\Controllers\API\ParkingAttendanceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [UserController::class, 'login'])->name('api.login');


Route::post('/register', [UserController::class, 'register']);


Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{user}', [UserController::class, 'update']);
Route::delete('/users/{user}', [UserController::class, 'destroy']);


Route::get('parkingslots', [ParkingSlotController::class, 'index']);
Route::get('parkingslots/{id}', [ParkingSlotController::class, 'apiShow']);
Route::post('parkingslots', [ParkingSlotController::class, 'store']);
Route::put('parkingslots/{parkingslot}', [ParkingSlotController::class, 'update']);
Route::delete('parkingslots/{parkingslot}', [ParkingSlotController::class, 'destroy']);

Route::get('parkingattendances', [ParkingAttendanceController::class, 'index']);

Route::post('parkingactivities', [ParkingActivitieController::class, 'store']);
Route::get('parkingactivities', [ParkingActivitieController::class, 'index']);
Route::put('parkingactivities/{parkingactivity}', [ParkingActivitieController::class, 'update']);


Route::get('parkingcomplaints', [ParkingComplaintController::class, 'index']);
Route::post('parkingcomplaints', [ParkingComplaintController::class, 'store']);


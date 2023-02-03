<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityTypeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\ReservationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:passport')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('me', 'me');
});

Route::controller(DestinationController::class)->group(function () {
    Route::get('destinations', 'index');
    Route::post('destination', 'store');
    Route::get('destination/{id}', 'show');
    Route::put('destination/{id}', 'update');
    Route::delete('destination/{id}', 'destroy');
});

Route::controller(ActivityController::class)->group(function () {
    Route::get('activities', 'index');
    Route::post('activities', 'store');
    Route::get('activities/{id}', 'show');
    Route::put('activities/{id}', 'update');
    Route::delete('activities/{id}', 'destroy');
});

Route::controller(ActivityTypeController::class)->group(function () {
    Route::get('activity_types', 'index');
    Route::post('activity_types', 'store');
    Route::get('activity_types/{id}', 'show');
    Route::put('activity_types/{id}', 'update');
    Route::delete('activity_types/{id}', 'destroy');
});


Route::controller(ReservationController::class)->group(function () {
    Route::get('reservations', 'index');
    Route::post('reservations', 'store');
    Route::get('reservations/{id}', 'show');
    Route::delete('reservations/{id}', 'destroy');
});

Route::controller(OperatorController::class)->group(function () {
    Route::post('operator/login', 'login');
    Route::post('operator/register', 'register');
    Route::post('operator/logout', 'logout');
    Route::post('operator/refresh', 'refresh');
    Route::post('operator/me', 'me');
});

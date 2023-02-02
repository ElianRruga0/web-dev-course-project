<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityTypeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DestinationController;
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
    Route::post('destination', 'store')->middleware('auth:api');
    Route::get('destination/{id}', 'show');
    Route::put('destination/{id}', 'update')->middleware('auth:api');
    Route::delete('destination/{id}', 'destroy')->middleware('auth:api');
});

Route::controller(ActivityController::class)->group(function () {
    Route::get('activities', 'index');
    Route::post('activities', 'store')->middleware('auth:api');
    Route::get('activities/{id}', 'show');
    Route::put('activities/{id}', 'update')->middleware('auth:api');
    Route::delete('activities/{id}', 'destroy')->middleware('auth:api');
});

Route::controller(ActivityTypeController::class)->group(function () {
    Route::get('activity_types', 'index');
    Route::post('activity_types', 'store')->middleware('auth:api');
    Route::get('activity_types/{id}', 'show');
    Route::put('activity_types/{id}', 'update')->middleware('auth:api');
    Route::delete('activity_types/{id}', 'destroy')->middleware('auth:api');
});


Route::controller(ReservationController::class)->group(function () {
    Route::get('reservations', 'index')->middleware('auth:api');
    Route::post('reservations', 'store');
    Route::get('reservations/{id}', 'show')->middleware('auth:api');;
    Route::delete('reservations/{id}', 'destroy')->middleware('auth:api');
});

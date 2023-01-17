<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DestinationController;
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
    // Route::post('destination', 'store');
    Route::get('activity/{id}', 'show');
    // Route::put('destination/{id}', 'update');
    // Route::delete('destination/{id}', 'destroy');
});

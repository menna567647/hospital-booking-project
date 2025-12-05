<?php

use App\Http\Controllers\Api\v1\GeneralController;
use App\Http\Controllers\Api\v1\MessageController;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\BookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1'], function () {
    Route::get('doctors/schedules', [GeneralController::class, 'doctorSchedules']);
    Route::get('departments', [GeneralController::class, 'departments']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('messages/store', [MessageController::class, 'store']);
        Route::get('client/bookings', [BookingController::class, 'index']);
        Route::post('appointment/booking/{id}', [BookingController::class, 'bookAnAppointment']);
        Route::delete('client/bookings/delete/{id}', [BookingController::class, 'destroy']);
        Route::delete('client/bookings/deleteAll', [BookingController::class, 'deleteAll']);
    });
});

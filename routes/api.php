<?php

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

Route::resource('/users', \App\Http\Controllers\Api\UserController::class)
    ->except(['create', 'edit'])
    ->middleware('auth:api')
    ->names('users');

Route::resource('/reservations', \App\Http\Controllers\Api\ReservationController::class)
    ->except(['create', 'edit'])
    ->middleware('auth:api')
    ->names('reservations');

Route::resource('/room_types', \App\Http\Controllers\Api\RoomTypeController::class)
    ->except(['create', 'edit'])
    ->middleware('auth:api')
    ->names('room_types');

Route::resource('/rooms', \App\Http\Controllers\Api\RoomController::class)
    ->except(['create', 'edit'])
    ->middleware('auth:api')
    ->names('room_types');

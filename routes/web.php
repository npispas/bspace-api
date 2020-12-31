<?php

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

Route::group(['prefix' => 'dashboard'], function () {

    Auth::routes();

    Route::get('/{component?}/{foo?}/{bar?}', \App\Http\Controllers\Web\DashboardController::class)
        ->middleware('auth')
        ->name('dashboard');
});

Route::group(['prefix' => 'api', 'middleware' => ['auth', 'json.response']], function () {

    Route::resource('/users', \App\Http\Controllers\Api\UserController::class)
        ->except(['create', 'edit'])
        ->names('users');

    Route::get('/reservations/generate', [\App\Http\Controllers\Api\ReservationController::class, 'generate'])
        ->name('reservations.generate');

    Route::resource('/reservations', \App\Http\Controllers\Api\ReservationController::class)
        ->except(['create', 'edit'])
        ->names('reservations');

    Route::resource('/room_types', \App\Http\Controllers\Api\RoomTypeController::class)
        ->except(['create', 'edit'])
        ->names('room_types');

    Route::resource('/rooms', \App\Http\Controllers\Api\RoomController::class)
        ->except(['create', 'edit'])
        ->names('room_types');

});

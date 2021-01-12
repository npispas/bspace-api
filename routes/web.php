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

    Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])
        ->middleware('guest')
        ->name('login');

    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])
        ->middleware('guest');

    Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);

    Route::get('/{any?}', \App\Http\Controllers\Web\DashboardController::class)
        ->where('any', '.*')
        ->middleware('auth');
});

Route::group(['prefix' => 'api', 'middleware' => ['auth', 'json.response']], function () {

    Route::get('/statistics', \App\Http\Controllers\Api\StatisticController::class)
        ->name('statistics');

    Route::get('/auth/permissions', [\App\Http\Controllers\Auth\UserController::class, 'permissions'])
        ->name('users.permissions');

    Route::resource('/users', \App\Http\Controllers\Api\UserController::class)
        ->except(['create', 'edit'])
        ->names('users');

    Route::get('/roles', [\App\Http\Controllers\Api\RoleController::class, 'index'])
        ->name('roles');

    Route::get('/permissions',[\App\Http\Controllers\Api\PermissionController::class, 'index'])
        ->name('permissions.index');

    Route::get('/reservations/generate', [\App\Http\Controllers\Api\ReservationController::class, 'generate'])
        ->name('reservations.generate');

    Route::resource('/reservations', \App\Http\Controllers\Api\ReservationController::class)
        ->except(['create', 'edit'])
        ->names('reservations');

    Route::resource('/room_types', \App\Http\Controllers\Api\RoomTypeController::class)
        ->only(['index', 'show'])
        ->names('room_types');

    Route::resource('/rooms', \App\Http\Controllers\Api\RoomController::class)
        ->except(['create', 'edit'])
        ->names('room_types');

});

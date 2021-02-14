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

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/metrics', \App\Http\Controllers\Api\MetricController::class)
        ->name('metrics');

    Route::post('/auth/user/image', [\App\Http\Controllers\Auth\UserController::class, 'storeImage'])
        ->name('auth.user.image.store');

    Route::get('/user', [\App\Http\Controllers\Auth\UserController::class, 'getAuthUser'])
        ->name('auth.user');

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

    Route::delete('/rooms/{room}/image/{image}', [\App\Http\Controllers\Api\RoomController::class, 'deleteImage'])
        ->name('rooms.image.delete');

    Route::resource('/rooms', \App\Http\Controllers\Api\RoomController::class)
        ->except(['create', 'edit'])
        ->names('rooms');
});

Route::post('/reservations/search', [\App\Http\Controllers\Api\ReservationController::class, 'search']);
Route::post('/reservations/{reservation}/checkin', [\App\Http\Controllers\Api\ReservationController::class, 'checkin']);

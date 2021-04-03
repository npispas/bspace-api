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

Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])
    ->middleware('guest');

Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])
    ->middleware('guest');

Route::get('/redirect', [\App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider'])
    ->middleware('guest');

Route::get('/callback', [\App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback'])
    ->middleware('guest');

Route::get('email/verify/{id}', [\App\Http\Controllers\Auth\VerificationController::class, 'verify'])
    ->name('verification.verify');

Route::get('email/resend', [\App\Http\Controllers\Auth\VerificationController::class, 'resend'])
    ->name('verification.resend');

Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);

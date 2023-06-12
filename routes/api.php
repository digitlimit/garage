<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\ClosedSlotController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/auth/login', [AuthController::class, 'login'])
->name('auth.login');

Route::post('/bookings',   [BookingController::class, 'create'])
->name('bookings.create');

Route::middleware('auth:sanctum')
->group(function () 
{
    Route::controller(AuthController::class)
    ->prefix('auth')
    ->name('auth.')
    ->group(function () {
        Route::post('/logout', 'logout')->name('logout');
    });

    Route::controller(BookingController::class)
    ->prefix('bookings')
    ->name('bookings.')
    ->group(function () {
        Route::get('/{booking}',  'view')->name('view')->can('view', 'booking');
        Route::get('/',           'list')->name('list')->can('list', 'booking');
    });

    Route::controller(ClosedSlotController::class)
    ->prefix('slots')
    ->name('slots.')
    ->group(function () {
        Route::get('/',           'list')->name('list')->can('list', 'slot');
        Route::post('/block',     'block')->name('block')->can('block', 'slot');
        Route::delete('/unblock', 'unblock')->name('unblock')->can('unblock', 'slot');
    });

});

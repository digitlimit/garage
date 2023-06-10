<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\SlotController;

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
        Route::get('/',  'list')->name('list')->can('list', 'booking');
    });

    Route::controller(SlotController::class)
    ->prefix('slots')
    ->name('slots.')
    ->group(function () {
        Route::post('/close', 'close')->name('close')->can('close', 'slot');
        Route::post('/open',  'open')->name('open')->can('open', 'slot');
    });

});

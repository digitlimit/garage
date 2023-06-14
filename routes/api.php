<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\SlotController;

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

#--------------------------------------------------------------------------
# Guests Routes
#--------------------------------------------------------------------------
Route::controller(AuthController::class)
->prefix('auth')
->name('auth.')
->group(function () {
    Route::post('login', 'login')->name('login');
});

Route::controller(BookingController::class)
->prefix('bookings')
->name('bookings.')
->group(function () {
    // Route::get('/',   'list')->name('list');
    Route::post('/',   'create')->name('create');
});

Route::controller(SlotController::class)
->prefix('slots')
->name('slots.')
->group(function () {
    Route::get('/',       'list')->name('list');
    Route::get('/closed', 'closed')->name('closed');
});

#--------------------------------------------------------------------------
# Auth Protected Routes
#--------------------------------------------------------------------------
Route::middleware('auth:sanctum')
->group(function () 
{
    Route::controller(AuthController::class)
    ->prefix('auth')
    ->name('auth.')
    ->group(function () {
        Route::get('/user',    'user')->name('user');
        Route::post('/logout', 'logout')->name('logout');
    });

    // Route::controller(BookingController::class)
    // ->prefix('bookings')
    // ->name('bookings.')
    // ->group(function () {
    //     Route::get('/',           'list')->name('list')->can('list', 'booking');
    //     Route::get('/{booking}',  'view')->name('view')->can('view', 'booking');
    // });

    Route::controller(SlotController::class)
    ->prefix('slots')
    ->name('slots.')
    ->group(function () {
        Route::post('/close/{slot}',  'close')->name('close')->can('close', 'slot');
        Route::delete('/open/{slot}', 'open')->name('open')->can('open', 'slot');
    });
});

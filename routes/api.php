<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\SlotController;
use App\Models\Booking;
use App\Models\Slot;

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
Route::post('auth/login',  [AuthController::class, 'login'])->name('auth.login');
Route::post('bookings',    [BookingController::class, 'create'])->name('bookings.create');

Route::controller(SlotController::class)
->prefix('slots')
->name('slots.')
->group(function () {
    Route::get('/',            'list')->name('list');
    Route::get('booked-slots', 'BookedSlots')->name('booked-slots');
    Route::get('closed-slots', 'closedSlots')->name('closed-slots');
    Route::get('closed-dates', 'closedDates')->name('closed-dates');  
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

    Route::controller(BookingController::class)
    ->prefix('bookings')
    ->name('bookings.')
    ->group(function () {
        Route::get('/', 'list')->name('list')->can('list', Booking::class);
    });

    Route::controller(SlotController::class)
    ->prefix('slots')
    ->name('slots.')
    ->group(function () {
        Route::post('/close', 'closeSlot')->name('close')->can('close', Slot::class);
        Route::post('/open', 'openSlot')->name('open')->can('open', Slot::class);
    });

});

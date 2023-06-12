<?php

use App\Http\Controllers\Admin\Booking\BookingManageController;
use App\Http\Controllers\Booking\BookingController;
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

Route::get('/', function () {
    return view('front.main_page');
});


Route::prefix('admin')->name('admin.')->group(static function () {
    Route::get('/', [BookingManageController::class, 'index'])->name('index');
    Route::prefix('booking')->name('booking.')->group(static function () {
        Route::post('/accept/{bookingRow}', [BookingManageController::class, 'acceptBookingRow'])->name('accept');
        Route::delete('/delete/{bookingRow}', [BookingManageController::class, 'destroyBookingRow'])->name('delete');
    });
});

Route::prefix('booking')->name('booking.')->group(static function () {
    Route::get('/get-date', [BookingController::class, 'index'])->name('index');
    Route::post('/create/application', [BookingController::class, 'createBookingRow'])->name('create');
});

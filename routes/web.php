<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\BookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\RoomImageController;

// Guest Routes
Route::get('/', [BookingController::class, 'index'])->name('home');
Route::post('/check-availability', [BookingController::class, 'checkAvailability'])->name('booking.check-availability');
Route::get('/room/{id}', [BookingController::class, 'showRoom'])->name('booking.room');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/confirmation/{id}', [BookingController::class, 'confirmation'])->name('booking.confirmation');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('rooms', RoomController::class);
    Route::post('rooms/{room}/images', [RoomImageController::class, 'store'])->name('rooms.images.store');
    Route::delete('room-images/{id}', [RoomImageController::class, 'destroy'])->name('rooms.images.destroy');
    Route::resource('bookings', AdminBookingController::class)->only(['index', 'show', 'update', 'destroy']);
});

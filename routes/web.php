<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')
    ->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

Route::middleware(['auth'])
    ->group(function() {
        Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.home');
        Route::get('/vehicles/create', [VehicleController::class,'create'])->name('vehicles.create');
        Route::post('/vehicles/create', [VehicleController::class,'store'])->name('vehicles.store');
        Route::get('/vehicles/edit/{vehicle}', [VehicleController::class,'edit'])->name('vehicles.edit');
        Route::post('/vehicles/edit/{vehicle}', [VehicleController::class,'update'])->name('vehicles.update');
        Route::get('/vehicles/delete/{vehicle}', [VehicleController::class,'destroy'])->name('vehicles.destroy');
    });

Route::middleware(['auth'])
    ->group(function() {
        Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.home');
        Route::get('/bookings/create', [BookingController::class,'create'])->name('bookings.create');
        Route::post('/bookings/create', [BookingController::class,'store'])->name('bookings.store');
        Route::get('/bookings/edit/{vehicle}', [BookingController::class,'edit'])->name('bookings.edit');
        Route::post('/bookings/edit/{vehicle}', [BookingController::class,'update'])->name('bookings.update');
        Route::get('/bookings/delete/{vehicle}', [BookingController::class,'destroy'])->name('bookings.destroy');
    });

require __DIR__.'/auth.php';

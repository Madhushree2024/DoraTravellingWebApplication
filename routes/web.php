<?php

use App\Http\Controllers\AdventureTripController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Adventure Trips Routes
    Route::resource('adventure-trips', AdventureTripController::class);
    
    // Booking Routes
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/adventure-trips/{adventureTrip}/book', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/adventure-trips/{adventureTrip}/book', [BookingController::class, 'store'])->name('bookings.store');
    Route::patch('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    
    // Review Routes
    Route::post('/adventure-trips/{adventureTrip}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::get('/my-reviews', [ReviewController::class, 'myReviews'])->name('reviews.my')->middleware('auth');
    Route::post('/trips/{adventureTrip}/reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');
});

require __DIR__.'/auth.php';
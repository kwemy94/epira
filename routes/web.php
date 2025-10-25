<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\InsurerController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    # Patient
    Route::resource('/patient', PatientController::class);
    Route::resource('/insurer', InsurerController::class);
    Route::resource('/contact', ContactController::class);
});

require __DIR__.'/auth.php';

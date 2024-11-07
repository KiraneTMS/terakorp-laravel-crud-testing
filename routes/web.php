<?php

use App\Http\Controllers\HospitalController;
use App\Http\Controllers\PatientController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Apply 'auth' middleware to group protected routes
Route::middleware(['auth'])->group(function () {
    // Dashboard route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // resource routes for hospitals and patients
    Route::resource('hospitals', HospitalController::class);
    Route::resource('patients', PatientController::class);


    Route::get('/hospitals', [HospitalController::class, 'index'])->name('hospitals.index');
    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');

});

require __DIR__.'/auth.php';
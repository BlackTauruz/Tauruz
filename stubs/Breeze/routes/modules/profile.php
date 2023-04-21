<?php

use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Profile\ProfilePasswordController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->prefix('profile')->name('profile.')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });
    Route::put('password', ProfilePasswordController::class)->name('password');
});

<?php

use App\Models\Point;
use App\Http\Controllers\HelpDashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $points = Point::all();
    return view('welcome', compact('points'));
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/help-dashboard', HelpDashboardController::class);
});

require __DIR__ . '/auth.php';

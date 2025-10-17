<?php
use App\Models\Point;

use App\Http\Controllers\HelpDashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Получаем все точки из базы данных
    $points = Point::all();
    return view('welcome', compact('points'));
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Личный кабинет помощи
    Route::resource('/help-dashboard', HelpDashboardController::class);

//    Route::get('/help-dashboard', [HelpDashboardController::class, 'index'])->name('help.dashboard');

});

require __DIR__ . '/auth.php';

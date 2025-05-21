<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/bezoeker/dashboard', function () {
        return view('bezoeker.dashboard');
    })->name('bezoeker.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get(
        '/admin/dashboard',
        [\App\Http\Controllers\Admin\AdminDashboardController::class, 'index']
    )->name('admin.dashboard');

    Route::get(
        '/medewerker/dashboard',
        [\App\Http\Controllers\Medewerker\MedewerkerDashboardController::class, 'index']
    )->name('medewerker.dashboard');

    Route::resource('medewerker/accounten', \App\Http\Controllers\Medewerker\AccountenController::class)
        ->names('medewerker.accounten')
        ->parameters(['accounten' => 'account']);
});

require __DIR__.'/auth.php';

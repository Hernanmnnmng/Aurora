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
    
    // My tickets routes for bezoekers
    Route::get('/mijn-tickets', [\App\Http\Controllers\UserTicketController::class, 'index'])->name('bezoeker.tickets.index');
    Route::get('/mijn-tickets/{ticket}', [\App\Http\Controllers\UserTicketController::class, 'show'])->name('bezoeker.tickets.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Medewerker routes (only accessible to medewerker users)
    Route::middleware(['can:medewerker'])->group(function() {
        Route::get('/medewerker/dashboard', [\App\Http\Controllers\Medewerker\MedewerkerDashboardController::class, 'index'])->name('medewerker.dashboard');
        
        Route::resource('medewerker/accounten', \App\Http\Controllers\Medewerker\AccountenController::class)
            ->names('medewerker.accounten')
            ->parameters(['accounten' => 'account']);
            
        // Medewerker ticket routes
        Route::prefix('medewerker')->name('medewerker.')->group(function () {
            Route::get('/tickets', [\App\Http\Controllers\Medewerker\TicketController::class, 'index'])->name('tickets.index');
            Route::get('/tickets/scanner', [\App\Http\Controllers\Medewerker\TicketScannerController::class, 'index'])->name('tickets.scanner');
            Route::post('/tickets/verify', [\App\Http\Controllers\Medewerker\TicketScannerController::class, 'verify'])->name('tickets.verify');
        });
    });
});

// Bezoeker-only access to reviews
Route::middleware(['auth'])->group(function () {
    Route::get('/reviews', [\App\Http\Controllers\ReviewController::class, 'index'])->name('reviews.index');
    Route::post('/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
});

// Admin routes (only accessible to admin users)
Route::middleware(['auth', 'can:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('accounts', \App\Http\Controllers\Admin\AccountController::class)
        ->names('accounts')
        ->parameters(['accounts' => 'account']);
    Route::resource('medewerkers', \App\Http\Controllers\Admin\MedewerkerController::class)
        ->names('medewerkers')
        ->parameters(['medewerkers' => 'medewerker']);
    
    // Tickets management
    Route::resource('tickets', \App\Http\Controllers\Admin\TicketController::class);
    Route::get('/tickets/scanner', [\App\Http\Controllers\Admin\TicketController::class, 'scanner'])->name('tickets.scanner');
    Route::post('/tickets/verify', [\App\Http\Controllers\Admin\TicketController::class, 'verify'])->name('tickets.verify');
    Route::post('/tickets/{ticket}/cancel', [\App\Http\Controllers\Admin\TicketController::class, 'cancel'])->name('tickets.cancel');
    
    Route::get('/reservations', [\App\Http\Controllers\Admin\ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/performances', [\App\Http\Controllers\Admin\PerformanceController::class, 'index'])->name('performances.index');
    Route::get('/contacts', [\App\Http\Controllers\Admin\ContactController::class, 'index'])->name('contacts.index');
});

require __DIR__.'/auth.php';
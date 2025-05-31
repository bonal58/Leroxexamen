<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ScooterController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\ServiceController;

// Taalwisseling route
Route::get('language/{locale}', [LanguageController::class, 'switchLang'])->name('language.switch');

// Openbare routes
Route::get('/', function () {
    $featuredScooters = \App\Models\Scooter::where('featured', true)->take(3)->get();
    return view('welcome', compact('featuredScooters'));
})->name('home');

// Contact route
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Taaltest route
Route::get('/language-test', function () {
    return view('language-test');
})->name('language.test');

// Resource routes
// Scooters routes
Route::get('scooters', [ScooterController::class, 'index'])->name('scooters.index');

// Admin routes voor scooters
Route::middleware(['auth'])->group(function () {
    Route::get('scooters/create', [ScooterController::class, 'create'])->name('scooters.create');
    Route::post('scooters', [ScooterController::class, 'store'])->name('scooters.store');
    Route::get('scooters/{scooter}/edit', [ScooterController::class, 'edit'])->name('scooters.edit');
    Route::put('scooters/{scooter}', [ScooterController::class, 'update'])->name('scooters.update');
    Route::delete('scooters/{scooter}', [ScooterController::class, 'destroy'])->name('scooters.destroy');
});

// Deze route moet na de specifieke routes komen
Route::get('scooters/{scooter}', [ScooterController::class, 'show'])->name('scooters.show');

// Parts routes
Route::get('parts', [PartController::class, 'index'])->name('parts.index');

// Admin routes voor parts
Route::middleware(['auth'])->group(function () {
    Route::get('parts/create', [PartController::class, 'create'])->name('parts.create');
    Route::post('parts', [PartController::class, 'store'])->name('parts.store');
    Route::get('parts/{part}/edit', [PartController::class, 'edit'])->name('parts.edit');
    Route::put('parts/{part}', [PartController::class, 'update'])->name('parts.update');
    Route::delete('parts/{part}', [PartController::class, 'destroy'])->name('parts.destroy');
});

// Deze route moet na de specifieke routes komen
Route::get('parts/{part}', [PartController::class, 'show'])->name('parts.show');

// Services routes
Route::get('services', [ServiceController::class, 'index'])->name('services.index');

// Admin routes voor services
Route::middleware(['auth'])->group(function () {
    Route::get('services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('services/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
});

// Deze route moet na de specifieke routes komen
Route::get('services/{service}', [ServiceController::class, 'show'])->name('services.show');

// Authenticatie routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';

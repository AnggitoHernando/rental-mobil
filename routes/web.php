<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/mobil', [CarController::class, 'index'])->name('mobil.index');
    Route::get('/mobil/image/{car}', [CarController::class, 'getImage'])->name('mobil.image');
    Route::post('/mobil/image/simpan', [CarController::class, 'storageImage'])->name('mobil.image.storage');
    Route::post('/mobil/simpan', [CarController::class, 'store'])->name('mobil.store');
    Route::delete('/mobil/hapus/{car}', [CarController::class, 'destroy'])->name('mobil.destroy');
    Route::put('/mobil/update/{car}', [CarController::class, 'update'])->name('mobil.update');
});

require __DIR__ . '/auth.php';

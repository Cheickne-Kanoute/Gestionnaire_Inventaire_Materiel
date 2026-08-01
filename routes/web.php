<?php

use App\Http\Controllers\EquipementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('dashboard'));

// Route de ping publique pour maintenir le conteneur éveillé (Keep-Alive)
Route::get('/ping', function () {
    return response()->json(['status' => 'ok', 'timestamp' => now()->toDateTimeString()]);
});

// Routes protégées par authentification
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [EquipementController::class, 'dashboard'])->name('dashboard');
    Route::resource('equipements', EquipementController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


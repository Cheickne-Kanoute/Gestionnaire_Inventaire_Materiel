<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipementController;

Route::get('/', fn() => redirect()->route('dashboard'));

Route::get('/dashboard', [EquipementController::class, 'dashboard'])->name('dashboard');

Route::resource('equipements', EquipementController::class);

// Route de ping pour maintenir le conteneur éveillé (Keep-Alive)
Route::get('/ping', function () {
    return response()->json(['status' => 'ok', 'timestamp' => now()->toDateTimeString()]);
});



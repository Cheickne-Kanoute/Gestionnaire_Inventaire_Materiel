<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipementController;

Route::get('/', fn() => redirect()->route('dashboard'));

Route::get('/dashboard', [EquipementController::class, 'dashboard'])->name('dashboard');

Route::resource('equipements', EquipementController::class);


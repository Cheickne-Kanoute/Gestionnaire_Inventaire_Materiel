<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipementController;

Route::resource('equipements', EquipementController::class);

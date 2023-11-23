<?php

use App\Http\Controllers\OficiosController;
use Illuminate\Support\Facades\Route;

Route::resource("oficios", OficiosController::class)->middleware('auth');

Route::get('/oficios-general', [OficiosController::class, 'general'])->name('oficios.general');

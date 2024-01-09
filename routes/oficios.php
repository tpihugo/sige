<?php

use App\Http\Controllers\OficiosController;
use Illuminate\Support\Facades\Route;

Route::get('/oficios/{anio}',[OficiosController::class,'inicio'])->name('oficios.inicio')->middleware('auth');

Route::resource("oficios", OficiosController::class)->middleware('auth');


Route::get('/oficios-general', [OficiosController::class, 'general'])->name('oficios.general');


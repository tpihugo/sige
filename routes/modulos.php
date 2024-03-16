<?php

use App\Http\Controllers\ModulosController;
use Illuminate\Support\Facades\Route;

Route::resource('modulos', ModulosController::class)
    ->names('modulos')
    ->middleware(['auth:sanctum', 'auth', 'is-admin']);

Route::post('/eliminar-enlace', [ModulosController::class, 'eliminar_enlace'])
    ->name('eliminar.enlace')->middleware(['auth:sanctum', 'auth', 'is-admin']);

Route::post('/activar-enlace', [ModulosController::class, 'activar_enlace'])
    ->name('activar.enlace')->middleware(['auth:sanctum', 'auth', 'is-admin']);

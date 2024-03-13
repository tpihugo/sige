<?php

use App\Http\Controllers\OficiosController;
use Illuminate\Support\Facades\Route;

Route::resource("oficios", OficiosController::class)->middleware(['auth:sanctum', 'auth', 'is-admin']);

Route::get('/oficios-generales/{anio}', [OficiosController::class, 'inicio'])->name('oficios.inicio')
    ->middleware(['auth:sanctum', 'auth', 'is-admin']);

Route::get('/oficios-general', [OficiosController::class, 'general'])->name('oficios.general')
    ->middleware(['auth:sanctum', 'auth', 'is-admin']);

Route::get('/oficios-titulacion', [OficiosController::class, 'oficios_titulacion'])->name('oficios.titulacion')
    ->middleware( ['auth:sanctum', 'auth', 'is-admin']);

Route::post('/oficios-titulacion/enviar', [OficiosController::class, 'oficios_titulacion_notificar'])
    ->name('oficios.titulacion.enviar')->middleware(['auth:sanctum', 'auth', 'is-admin']);

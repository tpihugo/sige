<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntregaRecepcionController;

Route::resource('entrega-resguardante', EntregaRecepcionController::class)
    ->names('entrega-resguardante')
    ->middleware('auth');

Route::post('/guardar-registro', [EntregaRecepcionController::class, 'guardar'])->name('entregarRecepcion.guardar');

Route::get('/entrega-area', [EntregaRecepcionController::class, 'por_area_index'])
    ->name('entrega-area.index')
    ->middleware('auth');

    Route::get('/entrega-area/{id}', [EntregaRecepcionController::class, 'por_area'])
    ->name('entrega.area.equipos')
    ->middleware('auth');

    
?>

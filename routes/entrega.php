<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntregaRecepcionController;

Route::resource('entrega-recepcion', EntregaRecepcionController::class)
    ->names('entrega-recepcion')
    ->middleware('auth');

Route::post('/guardar-registro',[EntregaRecepcionController::class,'guardar'])
    ->name('entregarRecepcion.guardar');

?>

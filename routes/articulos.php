<?php

use App\Http\Controllers\ArticuloController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

Route::post('/buscador-articulos', [ArticuloController::class, 'buscador_articulos'])->name('articulos.buscador')->middleware('auth');

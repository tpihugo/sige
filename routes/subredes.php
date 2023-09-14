<?php

use App\Http\Controllers\SubredController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

Route::post('/busqueda-subred', [SubredController::class, 'busqueda_equipo'])->name('subredes.buscar')->middleware('auth');

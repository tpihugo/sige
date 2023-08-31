<?php

use App\Http\Controllers\IpController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

Route::post('/buscar_equipo/{id}',[IpController::class,'buscar_equipo'])->name('ip.buscar_equipo')->middleware('auth');
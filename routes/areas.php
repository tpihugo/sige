<?php

use App\Http\Controllers\AreaController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

Route::get('/buscadorer-equipos/{seede}/{edificio}', [AreaController::class, 'buscar_edificio'])->name('area.edificio_equipos')->middleware('auth');

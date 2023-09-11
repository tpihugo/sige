<?php

use App\Http\Controllers\TicketController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

Route::get('/tickets-reportes',[TicketController::class,'ticket_reporte'])->name('tickets.reporte')->middleware('auth');

Route::get('/tickets-reportes/{fecha}',[TicketController::class,'reporte_area'])->name('tickets.reporte-area')->middleware('auth');
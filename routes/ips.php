<?php

use App\Http\Controllers\IpController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

Route::post('/buscar_equipo/{id}', [IpController::class, 'buscar_equipo'])->name('ip.buscar_equipo')->middleware('auth');
Route::post("/filtroIpsasig", [
    "as" => "filtroIpsasig",
    "middleware" => "auth",
    "uses" => "App\Http\Controllers\IpController@filtroIpsasig",
]);
Route::get("/asignadas", [
    "as" => "asignadas",
    "middleware" => "auth",
    "uses" => "App\Http\Controllers\IpController@asignadas",
]);
Route::get("/delete_ip/{id}", [
    "as" => "delete_ip",
    "middleware" => "auth",
    "uses" => "App\Http\Controllers\IpController@delete_ip",
]);
Route::get("/desasignarEquipo/{id}", [
    "as" => "desasignarEquipo",
    "middleware" => "auth",
    "uses" => "App\Http\Controllers\IpController@desasignarEquipo",
]);

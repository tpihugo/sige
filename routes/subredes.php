<?php

use App\Http\Controllers\SubredController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;


Route::resource("subredes", "App\Http\Controllers\SubredController")->middleware('auth');

Route::get("/deletesubred/{id_subred}", [
    "as" => "deletesubred",
    "middleware" => "auth",
    "uses" => "App\Http\Controllers\SubredController@deletesubred",
]);

Route::get("/disponible/{id}", [
    "as" => "disponible",
    "middleware" => "auth",
    "uses" => "App\Http\Controllers\SubredController@disponible",
]);
Route::get("/ocupadas/{id}", [
    "as" => "ocupadas",
    "middleware" => "auth",
    "uses" => "App\Http\Controllers\SubredController@ocupadas",

]);
Route::post("/filtroSubredes", [
    "as" => "filtroSubredes",
    "middleware" => "auth",
    "uses" => "App\Http\Controllers\SubredController@filtroSubredes",
]);

Route::get("/delete-subred/{subred_id}", [
    "as" => "deletesubred",
    "middleware" => "auth",
    "uses" => "App\Http\Controllers\SubredController@delete_subred",
]);
Route::post("/filtroSubredes", [
    "as" => "filtroSubredes",
    "middleware" => "auth",
    "uses" => "App\Http\Controllers\SubredController@filtroSubredes",
]);

Route::post('/busqueda-subred', [SubredController::class, 'busqueda_equipo'])->name('subredes.buscar')->middleware('auth');

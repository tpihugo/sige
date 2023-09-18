<?php

use App\Http\Controllers\RequisicionController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

Route::resource('requisicion', 'App\Http\Controllers\RequisicionController');
//Requisicion
Route::post("/crear_requisicion", [
    "as" => "crear_requisicion",
    "middleware" => "auth",
    "uses" => "App\Http\Controllers\RequisicionController@store",
]);

//Requisicion
Route::resource('requisiciones', '\App\Http\Controllers\RequisicionController');

Route::get('/imprimirrequisicion/{id}', array(
    'as' => 'imprimirrequisicion',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\PDFController@imprimirrequisicion'
));
//Articulo_requisicion
Route::resource('articulos', '\App\Http\Controllers\ArticuloController');

Route::get('requisicion/{id}/articulos/create',);

Route::get('requisicion/{id}/articulos/create', array(
    'as' => 'requisicion-articulos-create',
    'middleware' => 'auth',
    'uses' => '\App\Http\Controllers\ArticuloController@create'
));
Route::get('requisicion/{id}/articulos/', array(
    'as' => 'requisicion-articulos',
    'middleware' => 'auth',
    'uses' => '\App\Http\Controllers\ArticuloController@index'
));


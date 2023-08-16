<?php

use App\Http\Controllers\UsuariosController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

Route::get('/user-detele/{id}',[UsuariosController::class,'delete'])->name('usuarios.delete')->middleware('auth');
<?php

use App\Http\Controllers\BibliografiaDigitalController;
use App\Http\Controllers\CuadernosController;
use App\Http\Controllers\RevistasController;
use App\Http\Controllers\LibrosController;
use App\Http\Controllers\PrestamosController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


# Rutas de bibliografia Digital

Route::get('bibliografia_digital',[BibliografiaDigitalController::class,'index'])->name('bibliografia_digital.index');

Route::get('bibliografia_digital/{bibliografia}/edit',[BibliografiaDigitalController::class, 'edit'])->name('bibliografia_digital.edit');
Route::get('bibliografia/registro',[BibliografiaDigitalController::class,'registro'])->name('bibliografia_digital.registro');
Route::post('bibliografia_digital/create',[BibliografiaDigitalController::class,'create'])->name('bibliografia_digital.create');
Route::post('bibliografia_digital/update',[BibliografiaDigitalController::class,'update'])->name('bibliografia_digital.update');
Route::get('bibliografia/{bibliografia}/delete',[BibliografiaDigitalController::class,'delete'])->name('bibliografia_digital.delete');

Route::get('bibliografia_digital/{bibliogarfia}',[BibliografiaDigitalController::class,'show'])->name('bibliografia_digital.show');
Route::post('bibliografia/buscar',[BibliografiaDigitalController::class,'buscar'])->name('bibliografia_digital.buscar');

Route::get('bibliografia/resultados/{buscar_por}/{buscar}',[BibliografiaDigitalController::class,'resultados'])->name('bibliografia_digital.resultados');

# Rutas de Caudernos

Route::get('cuadernos',[CuadernosController::class,'index'])->name('cuadernos.index');
Route::get('cuadernos/{cuaderno}',[CuadernosController::class,'show'])->name('cuadernos.show');
Route::get('cuadernos/{cuaderno}/edit',[CuadernosController::class,'edit'])->name('cuadernos.edit');

Route::get('cuaderno/registro/',[CuadernosController::class,'registro'])->name('cuadernos.registro');
Route::post('cuaderno/create',[CuadernosController::class,'create'])->name('cuadernos.create');
Route::post('cuadernos/update/{clasificacion}',[CuadernosController::class,'update'])->name('cuadernos.update');
Route::get('cuadernos/{cuaderno}/delete',[CuadernosController::class,'delete'])->name('cuadernos.delete');

Route::post('cuadernos/busqueda',[CuadernosController::class,'buscar'])->name('cuadernos.buscar');

Route::get('cuadernos/resultados/{buscar_por}/{buscar}',[CuadernosController::class,'resultados'])->name('cuadernos.resultados');
/*
Route::get('cuadernos/formulario_registro', array(
    'as' => 'registro',
    'middleware' => 'web',
    'uses' => 'App\Http\Controllers\CuadernosController@store'
));
*/

#Rutas Revistas

Route::get('revistas',[RevistasController::class,'index'])->name('revistas.index');
Route::get('revistas/{revista}',[RevistasController::class,'show'])->name('revistas.show');
Route::get('revistas/{revista}/edit',[RevistasController::class,'edit'])->name('revistas.edit');


Route::get('revista/registro',[RevistasController::class,'registro'])->name('revistas.registro');
Route::post('revistas/create',[RevistasController::class,'create'])->name('revistas.create');
Route::get('revistas/{revista}/delete',[RevistasController::class,'delete'])->name('revistas.delete');
Route::post('revistas/buscar',[RevistasController::class,'buscar'])->name('revistas.buscar');
Route::post('revistas/update',[RevistasController::class,'update'])->name('revistas.update');

Route::get('revistas/resultados/{buscar_por}/{buscar}',[RevistasController::class,'resultados'])->name('revistas.resultados');

#Rutas Libros

Route::get('libros',[LibrosController::class,'index'])->name('libros.index');
Route::get('libros/{libro}',[LibrosController::class,'show'])->name('libros.show');
Route::get('libros/{libro}/edit',[LibrosController::class,'edit'])->name('libros.edit');

Route::get('libro/registro',[LibrosController::class,'registro'])->name('libro.registro');
Route::post('libros/create',[LibrosController::class,'create'])->name('libros.create');
Route::post('libros/update/{clasificacion}',[LibrosController::class,'update'])->name('libros.update');
Route::get('libros/{libro}/delete',[LibrosController::class,'delete'])->name('libros.delete');
Route::get('libro/resultados/{buscar_por}/{buscar}',[LibrosController::class,'resultados'])->name('libros.resultados');

Route::post('libros/buscar',[LibrosController::class,'buscar'])->name('libros.buscar');

Auth::routes();

# Registro usuarios

Route::get('usuarios/registro',[UserController::class,'registro'])->name('usuario.registro');
Route::post('usuarios/create',[UserController::class,'create'])->name('usuario.create');
Route::get('usuarios',[UserController::class,'index'])->name('usuario.index');
Route::post('usuarios/buscar',[UserController::class,'search'])->name('usuarios.search');



# Prestamos

Route::get('prestamos',[PrestamosController::class,'index'])->name('prestamos.index');
Route::get('prestamos/{tipo}/{clasificacion}/registro',[PrestamosController::class,'registro'])->name('prestamos.registro');
Route::post('prestamos/create',[PrestamosController::class,'create'])->name('prestamos.create');
Route::get('prestamos/{tipo}/{clasificacion}/{fecha_presatdo}/{prestado_A}/cerrar',[PrestamosController::class,'cerrar_prestamo'])->name('prestamos.cerrar');
Route::post('prestamos/buscar',[PrestamosController::class,'search'])->name('prestamos.search');
Route::get('prestamos/resultados/{buscar_por}/{buscar}',[PrestamosController::class,'resultados'])->name('prestamos.resultados');



# Excel

Route::get('bibliografia', [BibliografiaDigitalController::class,'export'])->name('bibliografia.export');
Route::get('libro/export', [LibrosController::class,'export'])->name('libros.export');
Route::get('cuaderno/export', [CuadernosController::class,'export'])->name('cuadernos.export');
Route::get('revista/export', [RevistasController::class,'export'])->name('revistas.export');


# Perfil

Route::get('perfil',[UserController::class,'perfil'])->name('usuario.perfil');
Route::put('perfil',[UserController::class,'password_change'])->name('usuario.change_password');

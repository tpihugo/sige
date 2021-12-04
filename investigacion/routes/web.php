<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('home');
})->name('dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth:sanctum', 'verified'])->resource('proyectos', 'App\Http\Controllers\ProyectoController');
Route::middleware(['auth:sanctum', 'verified'])->resource('evaluaciones', 'App\Http\Controllers\EvaluacionController');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/documento/{filename}', array(
    'as' => 'documento',
    'uses' => 'App\Http\Controllers\ProyectoController@getDocumento'
));
Route::get('/documento-testado/{filename}', array(
    'as' => 'documento-testado',
    'uses' => 'App\Http\Controllers\ProyectoController@getDocumentoTestado'
));
Route::get('/rolar-definitivo/{proyecto_id}', array(
    'as' => 'rolar-definitivo',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\ProyectoController@rolar_definitivo'
));
Route::get('/imprimirpdf/{proyecto_id}', array(
    'as' => 'imprimirpdf',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\PDFController@imprimirProyecto'
));
Route::post('/asignar-evaluador', array(
    'as' => 'asignar-evaluador',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\ProyectoController@asignar_evaluador'
));
Route::get('/imprimir-evaluacion/{proyecto_id}', array(
    'as' => 'imprimir-evaluacion',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\PDFController@imprimirEvaluacion'
));
Route::get('/evaluacion-definitiva/{evaluacion_id}', array(
    'as' => 'evaluacion-definitiva',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\ProyectoController@evaluacionDefinitiva'
));
Route::get('/create-evaluacion/{proyecto_id}', array(
    'as' => 'create-evaluacion',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\EvaluacionController@create_evaluacion'
));
Route::get('/index-general', array(
    'as' => 'index-general',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\ProyectoController@index_general'
));
Route::get('/proyectos-evaluador', array(
    'as' => 'proyectos-evaluador',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\ProyectoController@proyectos_evaluador'
));

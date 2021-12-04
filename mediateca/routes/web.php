<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\MailController;
use Laravel\Jetstream\Rules\Role;

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


Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');

Route::get('/myprofile', function () {
    return view('myprofile');
});

//Rutas para envio de email.
Route::get('/send-email', [MailController::class, 'sendMail']);

// Rutas para categorias
Route::get('/foros', [App\Http\Controllers\categoriaController::class, 'foros_Filtro'])->name('foros');
Route::get('/conferencias', [App\Http\Controllers\categoriaController::class, 'conferencias_Filtro'])->name('conferencias');
Route::get('/clases_Magistrales', [App\Http\Controllers\categoriaController::class, 'clases_Magistrales_Filtro'])->name('clases_Magistrales');
Route::get('/transmisiones_En_Vivo', [App\Http\Controllers\categoriaController::class, 'transmisiones_En_Vivo_Filtro'])->name('transmisiones_En_Vivo');
Route::get('/video_Conferencias', [App\Http\Controllers\categoriaController::class, 'video_Conferencias_Filtro'])->name('video_Conferencias');
Route::get('/todos_los_videos', [App\Http\Controllers\categoriaController::class, 'todos_los_videos'])->name('todos_los_videos');

//rutas para mostrar al inicio
Route::put('/notActiveIndex/{id}', [App\Http\Controllers\MaterialController::class, 'notActiveIndex'])->name('notActiveIndex');
Route::put('/activeIndex/{id}', [App\Http\Controllers\MaterialController::class, 'activeIndex'])->name('activeIndex');

//Rutas para mostar en carousel
Route::put('/carouselHidden/{id}', [App\Http\Controllers\MaterialController::class, 'carouselHidden'])->name('carouselHidden');
Route::put('/carouselShow/{id}', [App\Http\Controllers\MaterialController::class, 'carouselShow'])->name('carouselShow');

Route::put('/delete/{id}', [App\Http\Controllers\MaterialController::class, 'delete'])->name('delete');
Route::put('/{id}/edit', [App\Http\Controllers\MaterialController::class, 'edit'])->name('material.edit');


Route::get('/inicio', [App\Http\Controllers\MaterialController::class, 'index'])->name('material.index');
Route::resource('material','App\Http\Controllers\MaterialController');

Route::resource('home','App\Http\Controllers\MaterialController');
Route::resource('myprofile','App\Http\Controllers\ProfileController');

Route::get('profiles', [App\Http\Controllers\ProfileController::class, 'usuarios'])->name('profile.index');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('materiales', '\App\Http\Controllers\MaterialController')->except(['create']);


// Route::get('/delete-material/{material_id}', array(
//     'as' => 'delete-material',
//     'middleware' => 'auth',
//     'uses' => 'App\Http\Controllers\MaterialController@delete_material'
// ));


// Rutas para mi perfil
Route::post('/myprofile', [ProfileController::class, 'save'])->name('myprofile.save');
Route::put('/myprofile', [ProfileController::class, 'update'])->name('myprofile.update');

Route::get('profiles/{usuario}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
Route::put('profiles/{usuario}/update', [ProfileController::class, 'update_user'])->name('profiles.update');
Route::delete('profiles/{usuario}/delete', [ProfileController::class, 'delete_user'])->name('profiles.delete');

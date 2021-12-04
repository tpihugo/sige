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

Route::middleware(['auth:sanctum', 'verified'])->get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home2', function(){
	return view('home2');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('home');
})->name('dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('usuarios','App\Http\Controllers\UsuariosController');
Route::resource('equipos', 'App\Http\Controllers\EquipoController');
Route::resource('areas', 'App\Http\Controllers\AreaController');
Route::resource('movimientos', 'App\Http\Controllers\MovimientoController');
Route::resource('inventario', 'App\Http\Controllers\InventarioController');
Route::resource('tickets', 'App\Http\Controllers\TicketController');
Route::resource('prestamos', 'App\Http\Controllers\PrestamoController');
Route::resource('mobiliarios', 'App\Http\Controllers\MobiliarioController');
Route::resource('cursos', 'App\Http\Controllers\CursoController');
Route::resource('logs', 'App\Http\Controllers\LogController');
Route::get('/cambiar-ubicacion/{equipo_id}/{tipo?}', array(
    'as' => 'cambiar-ubicacion',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\MovimientoController@create'
));
Route::get('/revision-inventario', array(
    'as' => 'revision-inventario',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\EquipoController@revisionInventario'
));
Route::get('/inventario-cta', array(
    'as' => 'inventario-cta',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\EquipoController@inventario_cta'
));
Route::post('/equipo-encontrado/{origen?}', array(
    'as' => 'equipo-encontrado',
    'middleware' => 'auth',
    'uses' => '\App\Http\Controllers\InventarioController@listarEquipoEncontrado'
));
Route::get('/delete-equipo/{equipo_id}', array(
    'as' => 'delete-equipo',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\EquipoController@delete_equipo'
));
Route::get('/registro-inventario/{equipo_id}/{revisor_id}/{inventario}/{origen}', array(
    'as' => 'registro-inventario',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\InventarioController@registroInventario'
));
Route::post('/busqueda', array(
    'as' => 'busqueda',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\EquipoController@busqueda'
));
Route::post('/busquedaEquiposTicket', array(
    'as' => 'busquedaEquiposTicket',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\EquipoController@busquedaEquiposTicket'
));
Route::post('/busquedaEquiposPrestamo', array(
    'as' => 'busquedaEquiposPrestamo',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\EquipoController@busquedaEquiposPrestamo'
));

Route::get('/busquedaAvanzada', array(
    'as' => 'busquedaAvanzada',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\EquipoController@busquedaAvanzada'
));
Route::post('/filtroTickets', array(
    'as' => 'filtroTickets',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\TicketController@filtroTickets'
));
Route::get('/generar-prestamo/{equipo_id}', array(
    'as' => 'generar-prestamo',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\PrestamoController@generarPrestamo'
));
Route::get('/quitar-equipo-prestado/{equipo_prestado}/{prestamo_id}', array(
    'as' => 'quitar-equipo-prestado',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\PrestamoController@quitarEquipoPrestado'
));
Route::get('/historial/{equipo_id}', array(
    'as' => 'historial',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\MovimientoController@historial'
));

Route::get('/imprimirPrestamo/{prestamo_id}', array(
    'as' => 'imprimirPrestamo',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\PDFController@imprimirPrestamo'
));

Route::get('/revisionTickets', array(
    'as' => 'revisionTickets',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\TicketController@revisionTickets'
));
Route::get('/recepcionEquipo/{ticket_id}', array(
    'as' => 'recepcionEquipo',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\TicketController@recepcionEquipo'
));
Route::get('/prestamoEquipos/{presetamo_id}', array(
    'as' => 'prestamoEquipos',
    'middleware' => 'auth',
    'uses' => '\App\Http\Controllers\PrestamoController@prestamoEquipos'
));

Route::get('/registrarEquipoTicket/{equipo_id}/{ticket_id}', array(
    'as' => 'registrarEquipoTicket',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\TicketController@registrarEquipoTicket'
));
Route::get('/registrarEquipoPrestamo/{equipo_id}/{prestamo_id}', array(
    'as' => 'registrarEquipoPrestamo',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\PrestamoController@registrarEquipoPrestamo'
));

Route::get('/eliminarEquipoTicket/{equipo_id}/{ticket_id}', array(
    'as' => 'eliminarEquipoTicket',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\TicketController@eliminarEquipoTicket'
));
Route::get('/eliminarEquipoPrestamo/{equipo_id}/{prestamo_id}', array(
    'as' => 'eliminarEquipoPrestamo',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\PrestamoController@eliminarEquipoPrestamo'
));

Route::get('/imprimirRecibo/{ticket_id}', array(
    'as' => 'imprimirRecibo',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\PDFController@imprimirRecibo'
));
Route::get('/delete-ticket/{ticket_id}', array(
    'as' => 'delete-ticket',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\TicketController@delete_ticket'
));
Route::get('/delete-area/{area_id}', array(
    'as' => 'delete-area',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\AreaController@delete_area'
));
Route::get('/delete-prestamo/{prestamo_id}', array(
    'as' => 'delete-prestamo',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\PrestamoController@delete_prestamo'
));
Route::get('/delete-mobiliario/{mobiliario_id}', array(
    'as' => 'delete-mobiliario',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\MobiliarioController@delete_mobiliario'
));
Route::get('/panel-inventario/{area_id?}', array(
    'as' => 'panel-inventario',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\InventarioController@index'
));
Route::post('/panel-inventario/{area_id?}', array(
    'as' => 'panel-prueba',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\InventarioController@panel'
));
Route::get('/inventario-por-area/{area_id}', array(
    'as' => 'inventario-por-area',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\InventarioController@inventario_por_area'
));
Route::get('/actualizacion-inventario/{area_id}', array(
    'as' => 'actualizacion-inventario',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\InventarioController@actualizacion_inventario'
));
 Route::get('/revision-inventario-anual', array(
    'as' => 'revision-inventario-anual',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\RevisionAnualEquipo@revision_inventario_anual'
));
Route::get('/inventario-localizado', array(
    'as' => 'inventario-localizado',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\InventarioController@inventario_localizado'
));
Route::get('/documento/{filename}', array(
    'as' => 'documento',
    'uses' => 'App\Http\Controllers\PrestamoController@obtenerdocumento'
));
Route::get('/inventario-detalle/{area_id}', array(
    'as' => 'inventario-detalle',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\InventarioController@inventario_detalle'
));
Route::get('/imprimir-ticket/{ticket_id}', array(
    'as' => 'imprimir-ticket',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\PrestamoController@generarPrestamo'
));
Route::post('/agregar-comentario', array(
    'as' => 'agregar-comentario',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\TicketController@agregarComentario'
));
Route::post('/filtroCursos', array(
    'as' => 'filtroCursos',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\CursoController@filtroCursos'
));
Route::get('/delete-curso/{curso_id}', array(
    'as' => 'delete-curso',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\CursoController@delete_curso'
));
Route::get('/cursos-presenciales/{ciclo}', array(
    'as' => 'cursos-presenciales',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\CursoController@cursos_presenciales'
));
Route::get('/cursos-laboratorios/{ciclo}', array(
    'as' => 'cursos-laboratorios',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\CursoController@cursos_laboratorios'
));

Route::get('/area-ticket/{sede}', array(
    'as' => 'area-ticket',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\AreaController@area_ticket'
));
Route::get('/images/{filename}', array(
    'as' => 'images',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\AreaController@getImage'
));
Route::get('/ticket-historial/{id?}', array(
    'as' => 'ticket-historial',
    'uses' => 'App\Http\Controllers\TicketController@historial'
));

Route::resource('proyectos', 'App\Http\Controllers\ProyectoController');
Route::resource('proyecto-actividad', 'App\Http\Controllers\ProyectoActividadController');
Route::get('/proyecto-actividad/{id_proyecto}/create', array(
    'as' => 'proyecto-actividad',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\ProyectoActividadController@create'
));
Route::get('/select/equipo', array(
    'as' => 'select-equipo',
    'middleware' => 'auth',
    'uses' => 'App\Http\Controllers\ProyectoActividadController@getEquipos'
));
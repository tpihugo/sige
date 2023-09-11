<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Equipo;
use App\Models\InventarioDetalle;
use App\Models\Vs_Conteo_Por_Area;
use App\Models\Vs_Equipo_Localizado;
use App\Models\Vs_Equipo_Detalle;
use App\Models\VsEquipo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;
use App\Models\Log;
use App\Models\VsTicket;
use DateTime;
use Illuminate\Support\Facades\Auth;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*Equipos*/
        $total_equipos = DB::table('equipos')
            ->select(DB::raw('COUNT(*) as cuenta_equipos'))
            ->where('tipo_sici', '!=', null)
            ->first();

        $total_equipos_localizados_sici = DB::table('equipos')
            ->select(DB::raw('COUNT(*) as cuenta_equipos_localizados_sici'))
            ->where('resguardante', '=', 'CTA')
            ->where('localizado_sici', '=', 'Si')
            ->first();

        $total_equipos_no_localizados_sici = DB::table('equipos')
            ->select(DB::raw('COUNT(*) as cuenta_equipos_no_localizados_sici'))
            ->where('resguardante', '=', 'CTA')
            ->where('localizado_sici', '=', 'No')
            ->first();

        /*Muebles*/
        $total_mobiliario = DB::table('mobiliario')
            ->select(DB::raw('COUNT(*) as cuenta_mobiliario'))
            ->first();

        $total_mobiliario_localizado_sici = DB::table('mobiliario')
            ->select(DB::raw('COUNT(*) as cuenta_mobiliario_localizado_sici'))
            ->where('localizado_sici', '=', 'S')
            ->first();

        $total_mobiliario_no_localizado_sici = DB::table('mobiliario')
            ->select(DB::raw('COUNT(*) as cuenta_mobiliario_no_localizado_sici'))
            ->where('localizado_sici', '=', 'N')
            ->first();

        /*Localizados*/
        $total_localizados = DB::table('inventariodetalle')
            ->select(DB::raw('COUNT(*) as cuenta_localizados'))
            ->where('estatus', '=', 'Localizado')
            ->first();

        /*Con incidentes*/
        $total_incidentes = DB::table('inventariodetalle')
            ->select(DB::raw('COUNT(*) as cuenta_incidentes'))
            ->where('estatus', '=', 'Revision')
            ->first();

        /*No localizados*/
        $total_no_localizados = $total_equipos_localizados_sici->cuenta_equipos_localizados_sici - $total_incidentes->cuenta_incidentes - $total_localizados->cuenta_localizados;

        /*Reportados a contralor�a*/
        $total_equipos_reportados = DB::table('equipos')
            ->select(DB::raw('COUNT(*) as cuenta_equipos_reportados'))
            ->where('resguardante', '=', 'CTA')
            ->where('localizado_sici', '=', 'No')
            ->first();
        $total_mobiliario_reportados = DB::table('mobiliario')
            ->select(DB::raw('COUNT(*) as cuenta_mobiliario_reportados'))
            ->where('localizado_sici', '=', 'N')
            ->first();
        $total_equipos_reportados->cuenta_equipos_reportados += $total_mobiliario_reportados->cuenta_mobiliario_reportados;

        /*AREAS*/
        $areas = Area::all();

        /*DATA TABLE*/
        //$equipos = VsEquipo::where('id_area','=',$area_id)->get();
        $conteo_por_area = Vs_Conteo_Por_Area::all();
        return view('inventario.estadisticas-generales')
            ->with('total_equipos', $total_equipos)
            ->with('total_mobiliario', $total_mobiliario)
            ->with('total_mobiliario_localizado_sici', $total_mobiliario_localizado_sici)
            ->with('total_mobiliario_no_localizado_sici', $total_mobiliario_no_localizado_sici)
            ->with('total_localizados', $total_localizados)
            ->with('total_incidentes', $total_incidentes)
            ->with('total_no_localizados', $total_no_localizados)
            ->with('total_equipos_reportados', $total_equipos_reportados)
            ->with('conteo_por_area', $conteo_por_area)
            ->with('total_equipos_localizados_sici', $total_equipos_localizados_sici)
            ->with('total_equipos_no_localizados_sici', $total_equipos_no_localizados_sici)
            ->with('areas', $areas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    //localizado
    public function inventario_localizado()
    {
        $Vsinventario_localizado = Vs_Equipo_Detalle::where('activo', '=', 1)->get();
        $inventariolocalizado = $this->cargarDT($Vsinventario_localizado);
        return view('inventario.inventario-localizado')->with('inventariolocalizado', $inventariolocalizado);
    }

    public function cargarDT($consulta)
    {
        $inventario_localizado = [];

        foreach ($consulta as $key => $value) {
            $ruta = 'eliminar' . $value['id'];
            $eliminar = route('delete-ticket', $value['id']);
            $actualizar = route('tickets.edit', $value['id']);

            $acciones =
                '
                <div class="btn-acciones">
                    <div class="btn-circle">
                        <a href="' .
                $actualizar .
                '" class="btn btn-success btn-sm" title="Actualizar">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="#' .
                $ruta .
                '" role="button" class="btn btn-danger btn-sm" data-toggle="modal" title="Eliminar">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </div>
                </div>
                <div class="modal fade" id="' .
                $ruta .
                '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">�Seguro que deseas eliminar este curso?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p class="text-primary">
                        <small>
                            ' .
                $value['id'] .
                ', ' .
                $value['datos_reporte'] .
                ', ' .
                $value['fecha_reporte'] .
                ', ' .
                $value['solicitante'] .
                '
                        </small>
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <a href="' .
                $eliminar .
                '" type="button" class="btn btn-danger">Eliminar</a>
                    </div>
                  </div>
                </div>
              </div>
            ';

            $inventario_localizado[$key] = [
                $value['id'],
                $value['udg_id'],
                $value['tipo_equipo'],
                $value['marca'],
                $value['modelo'],
                $value['numero_serie'],
                $value['detalles'],
                $value['area'],
                $value['localizado_sici'],
                $value['estatus'],
                $acciones
            ];
        }

        return $inventario_localizado;
    }

    public function inventario_express()
    {
        return view('inventario.inventario_express');
    }

    public function inventario_express2()
    {
        $inventario = '2023B';

        $sici = VsEquipo::select('tipo_sici', DB::raw('count(*) as total'), 'localizado_sici')->where('tipo_sici', '=', 'equipo')
            ->where('activo', 1)
            ->groupBy('localizado_sici')
            ->pluck('total', 'localizado_sici');

        $inventario_area = DB::table('vs_inventariodetalle')
            ->select('id_area', DB::raw('count(*) as total'), 'inventario')->where('tipo_sici', '=', 'equipo')->where('inventario', $inventario)
            ->groupBy('id_area')
            ->pluck('total', 'id_area');

        $areas = Area::with('inventario')->where('activo',1)->where('sede','=','Belenes')->get();
/*
        foreach ($areas as $key => $value) {
            echo $value->id . "  Area: ". $value->area ."  Inventario: ". $value->inventario->count()  . "<br>";
        }
        */

        $total_inventario =  DB::table('vs_inventariodetalle')->where('inventario', '=', $inventario)->count();


        $totales['total_inventario'] = $total_inventario;

        $totales['total'] = $sici['S'] + $sici['N'];

        $totales['S'] = $sici['S'];
        $totales['N'] = $sici['N'];

        $areas = DB::table('vs_equipos')
            ->select(DB::raw('COUNT(*) as equipos, id_area, area'))
            ->where('tipo_sici', '=', 'equipo')->where('activo', 1)->orderBy('id_area')
            ->groupBy('id_area')
            ->get();

        foreach ($areas as $key => $value) {
            //echo  $value->id_area . " ";
            $id_area = $value->id_area;
            if (isset($inventario_area[$id_area])) {
                //echo  $inventario[$id_area] ;
                $value->inventario =  $inventario_area[$id_area];
            } else {
                $value->inventario =  0;
            }

            if ($value->id_area == null) {
                $value->id_area = 0;
                $value->area = 'Desconocido';
            }
            $value->porcentaje = number_format(($value->inventario / $value->equipos) * 100, 1);
            //echo "<br>";
            //dd($value);
        }
        return view('inventario.inventario_express2', compact('totales', 'areas'));
        return $areas;
        /*;
        $areas = collect($areas);
        return view('inventario.inventario_express2', compact('totales', 'areas'));*/
    }

    public function recorrer($value)
    {
        $inventario = "2023A";


        if ($value->id_area == null) {
            $value->id_area = 0;
            $value->area = 'Desconocido';
        }
        $value->porcentaje = number_format(($cantidad / $value->equipos) * 100, 1);
        $value->inventario = $cantidad;
        //return $value;
        print_r($value);
    }

    public function AutomaticallyUpdateArea($area_id)
    {
        $area = Area::find($area_id);
        if ($area) {
            $area->ultimo_inventario = '2023';
            $area->update();
            //
            $log = new Log();
            $log->tabla = 'area';
            $mov = '';
            $mov = $mov . ' IdEquipo:' . $area->ultimo_inventario . 'se modifico desde:actualizacion_inventario.';
            $log->movimiento = $mov;
            $log->usuario_id = Auth::user()->id;
            $log->acciones = 'Edicion';
            $log->save();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $equipo_id = $request->input('equipo_id');
        $area_id = $request->input('area_id');
        $user_id = $request->input('user_id');
        $inventario = '2023B';
        $nota = $request->input('nota');
        $articulosRegistrados = InventarioDetalle::where([['id_equipo', '=', $equipo_id], ['inventario', '=', $inventario]])->count();
        if ($articulosRegistrados == 0) {
            $listadoEquipos = VsEquipo::where('id', '=', $equipo_id)->first();
            $registroInventario = new InventarioDetalle();
            $registroInventario->id_equipo = $equipo_id;
            $registroInventario->id_area = $area_id;
            $registroInventario->id_usuario = $user_id;
            $registroInventario->fecha = Carbon::now();
            $registroInventario->inventario = $inventario;
            $registroInventario->estatus = 'Localizado';
            $registroInventario->notas = $nota;
            $registroInventario->save();
            //
            $log = new Log();
            $log->tabla = 'InventarioDetalle';
            $mov = '';
            $mov = $mov . ' id_equipo:' . $registroInventario->id_equipo . ' id_area:' . $registroInventario->id_area . ' id_usuario' . $registroInventario->id_usuario;
            $mov = $mov . ' fecha:' . $registroInventario->fecha . ' inventario:' . $registroInventario->inventario . ' estatus' . $registroInventario->estatus;
            $mov = $mov . ' notas:' . $registroInventario->notas . '.';
            $log->movimiento = $mov;
            $log->usuario_id = Auth::user()->id;
            $log->acciones = 'Insercion';
            $log->save();
            //
            $mensaje = 'El articulo se registro como Localizado con Nota';
        } elseif ($articulosRegistrados == 1 && $nota) {
            $ArticuloSeleccionado = InventarioDetalle::where('id_equipo', $equipo_id)
                ->where('inventario', $inventario)
                ->first();
            $ArticuloSeleccionado->IdRevisor = $request->input('user_id');
            $ArticuloSeleccionado->notas = $nota;
            $ArticuloSeleccionado->update();
            $mensaje = 'El articulo se registro como Localizado con Nota';
        } else {
            $mensaje = 'El articulo ya se habia registrado como Localizado';
        }
        return redirect()
            ->route('inventario-por-area', $area_id)
            ->with([
                'message' => $mensaje,
            ]);
        return redirect('revision-inventario')->with([
            'message' => $mensaje,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function panel(Request $request)
    {
        $id_area = $request->input('id_area');

        return $this->index($id_area);
    }
    /*public function cambiar_area_inventario(Request $request){
        $id_area = $request->input('id_area');
        return $this->inventario_por_area($id_area);
    }*/
    public function inventario_por_area($area_id = 249)
    {

        $inventario = '2023B';
        /*Total equipos_en_sici*/

        $sici = VsEquipo::select('id_area', DB::raw('count(*) as total'), 'localizado_sici')->where('tipo_sici', '=', 'equipo')
            ->where('activo', 1)->where('id_area', '=', $area_id)
            ->groupBy('localizado_sici')
            ->pluck('total', 'localizado_sici');

        /* Localizados inventario Express*/
        $total_equipos_localizados = DB::table('vs_inventariodetalle')
            ->where('id_area', $area_id)
            ->where('inventario', $inventario)
            ->count();


        $inventario = '2023B';

        $equipos_locales = DB::table('vs_equipos')
            ->select('id', 'udg_id', 'tipo_equipo', 'marca', 'modelo', 'numero_serie', 'detalles', 'area', 'id_area')
            ->where('id_area', $area_id)
            ->where('tipo_sici', '=', 'equipo')
            ->get();

        foreach ($equipos_locales as $key => $value) {
            $ultimo_invemtario = DB::table('vs_inventariodetalle')
                ->where('id_area', $area_id)
                ->where('id_equipo', $value->id)
                ->where('inventario', $inventario)
                ->latest()
                ->first();
            if ($ultimo_invemtario == null) {
                $ultimo_invemtario = DB::table('inventario_detalles')
                    ->where('id_area', $area_id)
                    ->where('id_equipo', $value->id)
                    ->latest()
                    ->first();
                if ($ultimo_invemtario != null) {
                    $value->ultimo_inventario = ['estatus' => 'No localizado', 'fecha' => 'Ultimo inventario realizado' . $ultimo_invemtario->fecha, 'notas' => $ultimo_invemtario->notas];
                } else {
                    $value->ultimo_inventario = ['estatus' => 'No localizado', 'fecha' => 'Nunca'];
                }
            } else {
                $value->ultimo_inventario = ['estatus' => $ultimo_invemtario->estatus, 'fecha' => $ultimo_invemtario->fecha, 'notas' => $ultimo_invemtario->notas];
            }
        }

        $currentArea = Area::select('id', DB::raw("CONCAT(sede,' - ' , division,' - ',coordinacion,' - ',area) as Area"))
            ->where('id', $area_id)
            ->first();

        return view('inventario.inventario-area')
            ->with('area_actual', $currentArea)
            ->with('total_equipos_localizados', $total_equipos_localizados)
            ->with('equipos', $equipos_locales)
            ->with('area_id', $area_id);
    }
    public function listarEquipoEncontrado(Request $request)
    {
        $ciclo = '2023A';
        //Se hace la ruta, la ruta manda llamar el m�todo y el m�todo manda llamar la plantilla
        $listadoEquipos = DB::table('vs_equipo_detalles')
            ->distinct('id')
            ->where('vs_equipo_detalles.id', '=', $request->input('id'))
            ->orWhere('vs_equipo_detalles.udg_id', '=', $request->input('id'))
            ->orWhere('vs_equipo_detalles.numero_serie', 'like', '%' . $request->input('id') . '%')
            ->latest('inventario')
            ->get()
            ->unique('id');

        foreach ($listadoEquipos as $key => $value) {
            //echo $key . $value->estatus ." ". $value->inventario."<br>";

            if (strcmp($value->inventario, $ciclo) != 0) {
                $value->estatus = 'No Localizado';
            }
            if ($value->inventario == null) {
                $value->inventario = 'Sin registro';
            }
            if (!isset($value->notas)) {
                $value->notas = '-';
            }
        }

        if ($request->input('nota') != null) {
            $nota = $request->input('nota');
        } else {
            $nota = '-';
        }
        $origen = $request->input('origen');

        return view('equipo.equipo-encontrado', [
            'message' => 'El equipo se registro correctamente 2023A',
            'listadoEquipos' => $listadoEquipos,
            'nota' => $nota,
            'origen' => $origen,
        ]);
    }
    public function registroInventario($equipo_id, $origen = 'revision-inventario')
    {
        $revisor_id = Auth::user()->id;
        $articulosRegistrados = InventarioDetalle::where('id_equipo', $equipo_id)
            ->where('inventario', $origen)
            ->count();

        if ($articulosRegistrados == 0) {
            $listadoEquipos = VsEquipo::where('id', '=', $equipo_id)->first();
            $registroInventario = new InventarioDetalle();
            $registroInventario->id_equipo = $equipo_id;
            $registroInventario->id_area = $listadoEquipos->id_area;
            $registroInventario->id_usuario = $revisor_id;
            $registroInventario->fecha = Carbon::now();
            $registroInventario->inventario = $origen;
            $registroInventario->estatus = 'Localizado';
            $registroInventario->notas = '-';
            $registroInventario->save();
            //
            $log = new Log();
            $log->tabla = 'InventarioDetalle';
            $mov = '';
            $mov = $mov . ' id_equipo:' . $registroInventario->id_equipo . ' IdArea:' . $registroInventario->id_area . ' id_usuario' . $registroInventario->id_usuario;
            $mov = $mov . ' fecha:' . $registroInventario->fecha . ' inventario:' . $registroInventario->inventario . ' estatus' . $registroInventario->estatus;
            $mov = $mov . ' notas:' . $registroInventario->notas . '.';
            $log->movimiento = $mov;
            $log->usuario_id = Auth::user()->id;
            $log->acciones = 'Insercion';
            $log->save();
            //
            $mensaje = 'El articulo se registro como Localizado';
        } else {
            $mensaje = 'El articulo ya se habia registrado como Localizado';
        }

        //if($origen='inventario-area'){
        //  return redirect()->route('inventario-por-area', $listadoEquipos->id_area)->with(array('message' => $mensaje));
        //}else{
        return redirect()
            ->route('revision-inventario')
            ->with([
                'message' => $mensaje,
            ]);
        //}
    }
    public function actualizacion_inventario($area_id)
    {
        $area = Area::find($area_id);
        if ($area) {
            $area->ultimo_inventario = '2023';
            $area->update();
            //
            $log = new Log();
            $log->tabla = 'area';
            $mov = '';
            $mov = $mov . ' IdEquipo:' . $area->ultimo_inventario . 'se modifico desde:actualizacion_inventario.';
            $log->movimiento = $mov;
            $log->usuario_id = Auth::user()->id;
            $log->acciones = 'Edicion';
            $log->save();
            //
            return redirect()
                ->route('inventario-express-detalle2')
                ->with([
                    'message' => 'Se marco como último inventario 2023',
                ]);
        }
    }
    public function inventario_detalle($area_id)
    {
        /*Total equipos_en_sici*/
        $equipos_en_sici = DB::table('vs_equipos')
            ->select(DB::raw('COUNT(*) as cuenta_equipos'))
            ->where('resguardante', '=', 'CTA')
            ->where('id_area', '=', $area_id)
            ->first();
        /*Total equipos_localizados_sici*/
        $equipos_en_sici_localizados = DB::table('vs_equipos')
            ->select(DB::raw('COUNT(*) as cuenta_equipos'))
            ->where('resguardante', '=', 'CTA')
            ->where('localizado_sici', '=', 'S')
            ->where('id_area', '=', $area_id)
            ->first();
        /*Total equipos_no_localizados_sici*/
        $equipos_en_sici_no_localizados = DB::table('vs_equipos')
            ->select(DB::raw('COUNT(*) as cuenta_equipos'))
            ->where('resguardante', '=', 'CTA')
            ->where('localizado_sici', '=', 'No Encontrado')
            ->where('id_area', '=', $area_id)
            ->first();
        /* Localizados inventario Express*/
        $total_equipos_localizados = DB::table('inventariodetalle')
            ->select(DB::raw('COUNT(*) as localizados'))
            ->where('estatus', '=', 'Localizado')
            ->where('IdArea', '=', $area_id)
            ->first();
        /* Localizados*/
        $total_equipos_localizados = DB::table('inventariodetalle')
            ->select(DB::raw('COUNT(*) as localizados'))
            ->where('estatus', '=', 'Localizado')
            ->where('IdArea', '=', $area_id)
            ->first();

        /* Revisi�n con Nota*/
        $total_equipos_revision = DB::table('inventariodetalle')
            ->select(DB::raw('COUNT(*) as revisiones'))
            ->where('estatus', '=', 'Revision')
            ->where('IdArea', '=', $area_id)
            ->first();

        /*AREAS*/
        $origen = 'inventario-area';

        /*DATA TABLE*/
        $equipos = VsEquipo::where('id_area', '=', $area_id)->get();
        $total_equipos = count($equipos);

        //Cargar vista vs_equipos_detalles
        $equipos_detalle = Vs_Equipo_Detalle::where('id_area', '=', $area_id)->get();

        return view('inventario.inventario_detalle')
            ->with('total_equipos', $total_equipos)
            ->with('total_equipos_localizados', $total_equipos_localizados)
            ->with('total_equipos_revision', $total_equipos_revision)
            ->with('equipos', $equipos)
            ->with('equipos_en_sici', $equipos_en_sici)
            ->with('equipos_en_sici_localizados', $equipos_en_sici_localizados)
            ->with('equipos_en_sici_no_localizados', $equipos_en_sici_no_localizados)
            ->with('origen', $origen)
            ->with('equipos_detalle', $equipos_detalle);
    }

    public function dashboard_inventario()
    {
        // $total_equipos = Equipo::count();
        $total_equipos = DB::table('vs_equipos')
            ->select(DB::raw('COUNT(*) as localizados'))
            ->where('tipo_sici', 'equipo')
            ->where('resguardante', 'CTA')
            ->first();

        // $total_equipos_localizados_sici = Equipo::where('localizado_sici','Si')->get();
        $total_equipos_localizados_sici = DB::table('equipos')
            ->select(DB::raw('COUNT(*) as localizados_sici'))
            ->where('tipo_sici', 'equipo')
            ->where('localizado_sici', 'Si')
            ->where('resguardante', 'CTA')
            ->first();

        $total_cpu_localizados_sici = DB::table('equipos')
            ->select(DB::raw('COUNT(*) as cpu_localizados'))
            ->where('localizado_sici', 'Si')
            ->where('resguardante', 'CTA')
            ->where('tipo_equipo', 'CPU')
            ->first();

        $total_lap_localizadas_sici = DB::table('equipos')
            ->select(DB::raw('COUNT(*) as lap_localizadas'))
            ->where('localizado_sici', 'Si')
            ->where('resguardante', 'CTA')
            ->where('tipo_equipo', 'Laptop')
            ->first();

        $total_imp_localizadas_sici = DB::table('equipos')
            ->select(DB::raw('COUNT(*) as imp_localizadas'))
            ->where('localizado_sici', 'Si')
            ->where('resguardante', 'CTA')
            ->where('tipo_equipo', 'Impresora')
            ->first();

        $total_tablets_cta = DB::table('equipos')
            ->select(DB::raw('COUNT(*) as total_tablet_cta'))
            ->where('resguardante', 'CTA')
            ->where('tipo_equipo', 'Tablet')
            ->first();

        $total_tablets_android = DB::table('equipos')
            ->select(DB::raw('COUNT(*) as total_tablet_android'))
            ->where('resguardante', 'CTA')
            ->where('tipo_equipo', 'Tablet')
            ->where('marca', '<>', 'APPLE')
            ->first();

        $total_tablets_apple = DB::table('equipos')
            ->select(DB::raw('COUNT(*) as total_tablet_apple'))
            ->where('resguardante', 'CTA')
            ->where('tipo_equipo', 'Tablet')
            ->where('marca', 'APPLE')
            ->first();

        $total_equipos_no_localizados_sici = DB::table('equipos')
            ->select(DB::raw('COUNT(*) as no_localizados_sici'))
            ->where('tipo_sici', 'equipo')
            ->where('localizado_sici', 'No')
            ->where('resguardante', 'CTA')
            ->first();

        $total_cpu_no_localizados_sici = DB::table('equipos')
            ->select(DB::raw('COUNT(*) as cpu_localizados'))
            ->where('localizado_sici', 'No')
            ->where('resguardante', 'CTA')
            ->where('tipo_equipo', 'CPU')
            ->first();

        $total_lap_no_localizadas_sici = DB::table('equipos')
            ->select(DB::raw('COUNT(*) as lap_localizadas'))
            ->where('localizado_sici', 'No')
            ->where('resguardante', 'CTA')
            ->where('tipo_equipo', 'Laptop')
            ->first();

        $total_imp_no_localizadas_sici = DB::table('equipos')
            ->select(DB::raw('COUNT(*) as imp_localizadas'))
            ->where('localizado_sici', 'No')
            ->where('resguardante', 'CTA')
            ->where('tipo_equipo', 'Impresora')
            ->first();

        $total_equipos_localizados_inventario_anual = DB::table('inventariodetalle')
            ->select(DB::raw('COUNT(*) as localizados_inv'))
            ->where('estatus', 'Localizado')
            ->first();

        $total_equipos_localizados_con_nota = DB::table('inventariodetalle')
            ->select(DB::raw('COUNT(*) as localizados_nota'))
            ->where('notas', '<>', '-')
            ->first();

        // $vs_inventario_general = DB::table('vs_inventariogeneral')
        // ->select('*')
        // ->get();

        $total_cpu = DB::table('equipos')
            ->select(DB::raw('COUNT(*) as cpus'))
            ->where('tipo_equipo', 'CPU')
            ->where('resguardante', 'CTA')
            ->first();

        $total_lap = DB::table('equipos')
            ->select(DB::raw('COUNT(*) as laptop'))
            ->where('tipo_equipo', 'Laptop')
            ->where('resguardante', 'CTA')
            ->first();

        $total_imp = DB::table('equipos')
            ->select(DB::raw('COUNT(*) as impresora'))
            ->where('tipo_equipo', 'Impresora')
            ->where('resguardante', 'CTA')
            ->first();

        $vs_prestamos_porEntregar = DB::table('vs_prestamos')
            ->select(DB::raw('COUNT(*) as porEntregar'))
            ->where('estado', 'Por Entregar')
            ->first();

        $vs_prestamos_trasladado = DB::table('vs_prestamos')
            ->select(DB::raw('COUNT(*) as traladado'))
            ->where('estado', 'Traslado')
            ->first();

        $vs_prestamos_devuelto = DB::table('vs_prestamos')
            ->select(DB::raw('COUNT(*) as devuelto'))
            ->where('estado', 'Devuelto')
            ->first();

        $vs_prestamos_enPrestamo = DB::table('vs_prestamos')
            ->select(DB::raw('COUNT(*) as enPrestamo'))
            ->where('estado', 'En prestamo')
            ->first();

        // dd($vs_prestamos_enPrestamo);

        $dataTable[] = [$vs_prestamos_porEntregar, $vs_prestamos_trasladado, $vs_prestamos_devuelto, $vs_prestamos_enPrestamo];

        // dd($dataTable);

        return view('inventario.estadistica')
            ->with('total_equipos', $total_equipos)
            ->with('total_equipos_localizados_sici', $total_equipos_localizados_sici)
            ->with('total_cpu_localizados_sici', $total_cpu_localizados_sici)
            ->with('total_lap_localizadas_sici', $total_lap_localizadas_sici)
            ->with('total_imp_localizadas_sici', $total_imp_localizadas_sici)
            ->with('total_equipos_no_localizados_sici', $total_equipos_no_localizados_sici)
            ->with('total_cpu_no_localizados_sici', $total_cpu_no_localizados_sici)
            ->with('total_lap_no_localizadas_sici', $total_lap_no_localizadas_sici)
            ->with('total_imp_no_localizadas_sici', $total_imp_no_localizadas_sici)
            ->with('total_equipos_localizados_inventario_anual', $total_equipos_localizados_inventario_anual)
            ->with('total_equipos_localizados_con_nota', $total_equipos_localizados_con_nota)
            ->with('total_cpu', $total_cpu)
            ->with('total_lap', $total_lap)
            ->with('total_imp', $total_imp)
            ->with('total_tablets_cta', $total_tablets_cta)
            ->with('total_tablets_android', $total_tablets_android)
            ->with('total_tablets_apple', $total_tablets_apple)
            ->with('dataTable', $dataTable);
        // ->with('vs_inventario_general',$vs_inventario_general);
    }
}

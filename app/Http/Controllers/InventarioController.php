<?php

namespace App\Http\Controllers;

use App\Models\Area;
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
            ->where('resguardante', '=', 'CTA')
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
            ->where('estatus','=','Localizado')
            ->first();

        /*Con incidentes*/
        $total_incidentes = DB::table('inventariodetalle')
            ->select(DB::raw('COUNT(*) as cuenta_incidentes'))
            ->where('estatus','=','Revision')
            ->first();

        /*No localizados*/
        $total_no_localizados =$total_equipos_localizados_sici->cuenta_equipos_localizados_sici - $total_incidentes->cuenta_incidentes-$total_localizados->cuenta_localizados;

        /*Reportados a contraloría*/
        $total_equipos_reportados = DB::table('equipos')
            ->select(DB::raw('COUNT(*) as cuenta_equipos_reportados'))
            ->where('resguardante', '=', 'CTA')
            ->where('localizado_sici', '=', 'No')
            ->first();
        $total_mobiliario_reportados = DB::table('mobiliario')
            ->select(DB::raw('COUNT(*) as cuenta_mobiliario_reportados'))
            ->where('localizado_sici','=','N')
            ->first();
        $total_equipos_reportados->cuenta_equipos_reportados += $total_mobiliario_reportados->cuenta_mobiliario_reportados;

        /*AREAS*/
        $areas = Area::all();

            /*DATA TABLE*/
        //$equipos = VsEquipo::where('id_area','=',$area_id)->get();
        $conteo_por_area = Vs_Conteo_Por_Area::all();
        return view('inventario.estadisticas-generales')
            ->with('total_equipos',$total_equipos)
	        ->with('total_mobiliario',$total_mobiliario)
            ->with('total_mobiliario_localizado_sici', $total_mobiliario_localizado_sici)
            ->with('total_mobiliario_no_localizado_sici', $total_mobiliario_no_localizado_sici)
            ->with('total_localizados', $total_localizados)
            ->with('total_incidentes', $total_incidentes)
            ->with('total_no_localizados',$total_no_localizados)
            ->with('total_equipos_reportados',$total_equipos_reportados)
            ->with('conteo_por_area',$conteo_por_area)
            ->with('total_equipos_localizados_sici',$total_equipos_localizados_sici)
            ->with('total_equipos_no_localizados_sici',$total_equipos_no_localizados_sici)
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
        $inventario = '2021A';
        $nota = $request->input('nota');
        $articulosRegistrados=InventarioDetalle::where([['IdEquipo','=',$equipo_id], ['inventario','=', $inventario]])->count();
        if($articulosRegistrados==0) {
            $listadoEquipos = VsEquipo::where('id','=',$equipo_id)->first();
            $registroInventario = new InventarioDetalle();
            $registroInventario->IdEquipo = $equipo_id;
            $registroInventario->IdArea = $area_id;
            $registroInventario->IdRevisor = $user_id;
            $registroInventario->fechaHora = Carbon::now();
            $registroInventario->inventario = $inventario;
            $registroInventario->estatus = 'Localizado';
            $registroInventario->notas = $nota;
            $registroInventario->save();
	    //
            $log = new Log();
            $log->tabla = "InventarioDetalle";
            $mov="";
            $mov=$mov." IdEquipo:".$registroInventario->IdEquipo ." IdArea:". $registroInventario->IdArea ." IdRevisor" .$registroInventario->IdRevisor;
            $mov=$mov." fechaHora:".$registroInventario->fechaHora ." inventario:". $registroInventario->inventario ." estatus" .$registroInventario->estatus;
            $mov=$mov." notas:".$registroInventario->notas .".";
            $log->movimiento = $mov;
            $log->usuario_id = Auth::user()->id;
            $log->acciones = "Insercion";
            $log->save();
            //
            $mensaje = 'El artículo se registro como Localizado con Nota';
        }else{
            $mensaje = 'El artículo ya se había registrado como Localizado';
        }

        return redirect()->route('revision-inventario')->with(array('message' => $mensaje));
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

    public function panel(Request $request){

        $id_area = $request->input('id_area');

        return $this->index($id_area);
    }
    /*public function cambiar_area_inventario(Request $request){
        $id_area = $request->input('id_area');
        return $this->inventario_por_area($id_area);
    }*/
    public function inventario_por_area($area_id = 249){
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
            ->where('localizado_sici', '=', 'Si')
            ->where('id_area', '=', $area_id)
            ->first();
        /*Total equipos_no_localizados_sici*/
        $equipos_en_sici_no_localizados = DB::table('vs_equipos')
            ->select(DB::raw('COUNT(*) as cuenta_equipos'))
            ->where('resguardante', '=', 'CTA')
            ->where('localizado_sici', '=', 'No')
            ->where('id_area', '=', $area_id)
            ->first();
        /* Localizados inventario Express*/
        $total_equipos_localizados = DB::table('inventariodetalle')
            ->select(DB::raw('COUNT(*) as localizados'))
            ->where('estatus', '=', 'Localizado')
            ->where('IdArea', '=', $area_id)
            ->first();
        

        /* Revisión con Nota*/
        $total_equipos_revision = DB::table('inventariodetalle')
            ->select(DB::raw('COUNT(*) as revisiones'))
            ->where('estatus', '=', 'Revision')
            ->where('IdArea', '=', $area_id)
            ->first();

        /*AREAS*/

        $origen ='inventario-area';

        /*DATA TABLE*/
        
        $equipos= Vs_Equipo_Detalle::where('id_area','=',$area_id)->get();
        $total_equipos = count($equipos);
        return view('inventario.inventario-area')
            ->with('total_equipos',$total_equipos)
            ->with('total_equipos_localizados',$total_equipos_localizados)
            ->with('total_equipos_revision',$total_equipos_revision)
            ->with('equipos',$equipos)
            ->with('equipos_en_sici', $equipos_en_sici)
            ->with('equipos_en_sici_localizados', $equipos_en_sici_localizados)
            ->with('equipos_en_sici_no_localizados', $equipos_en_sici_no_localizados)
            ->with('origen', $origen)
            ->with('area_id',$area_id);
    }
    public function listarEquipoEncontrado(Request $request){
        //Se hace la ruta, la ruta manda llamar el método y el método manda llamar la plantilla
        $listadoEquipos = VsEquipo::where('id', '=', $request->input('id'))
            ->orWhere('udg_id', '=', $request->input('id'))
            ->orWhere('numero_serie', 'like', '%'.$request->input('id').'%')->get();
        if($request->input('nota')!=null){
            $nota = $request->input('nota');
        }else{
            $nota='-';
        }
        $origen=$request->input('origen');
        return view('equipo.equipo-encontrado', array(
            'listadoEquipos' => $listadoEquipos,
            'nota' => $nota,
            'origen' => $origen

        ));
    }
    public function registroInventario($equipo_id, $revisor_id, $inventario, $origen='revision-inventario'){
        $articulosRegistrados=InventarioDetalle::where([['IdEquipo','=',$equipo_id], ['inventario','=', $inventario]])->count();
        if($articulosRegistrados==0) {
            $listadoEquipos = VsEquipo::where('id','=',$equipo_id)->first();
            $registroInventario = new InventarioDetalle();
            $registroInventario->IdEquipo = $equipo_id;
            $registroInventario->IdArea = $listadoEquipos->id_area;
            $registroInventario->IdRevisor = $revisor_id;
            $registroInventario->fechaHora = Carbon::now();
            $registroInventario->inventario = $inventario;
            $registroInventario->estatus = 'Localizado';
            $registroInventario->notas = '-';
            $registroInventario->save();
	    //
            $log = new Log();
            $log->tabla = "InventarioDetalle";
            $mov="";
            $mov=$mov." IdEquipo:".$registroInventario->IdEquipo ." IdArea:". $registroInventario->IdArea ." IdRevisor" .$registroInventario->IdRevisor;
            $mov=$mov." fechaHora:".$registroInventario->fechaHora ." inventario:". $registroInventario->inventario ." estatus" .$registroInventario->estatus;
            $mov=$mov." notas:".$registroInventario->notas .".";
            $log->movimiento = $mov;
            $log->usuario_id = Auth::user()->id;
            $log->acciones = "Insercion";
            $log->save();
            //
            $mensaje = 'El artículo se registro como Localizado';
        }else{
            $mensaje = 'El artículo ya se había registrado como Localizado';
        }
        //if($origen='inventario-area'){
          //  return redirect()->route('inventario-por-area', $listadoEquipos->id_area)->with(array('message' => $mensaje));
        //}else{
            return redirect()->route('revision-inventario')->with(array('message' => $mensaje));
        //}
    }
    public function actualizacion_inventario($area_id)
    {
        $area = Area::find($area_id);
        if ($area) {
            $area->ultimo_inventario = '2021';
            $area->update();
	    //
            $log = new Log();
            $log->tabla = "area";
            $mov="";
            $mov=$mov." IdEquipo:".$area->ultimo_inventario ."se modifico desde:actualizacion_inventario.";
            $log->movimiento = $mov;
            $log->usuario_id = Auth::user()->id;
            $log->acciones = "Edicion";
            $log->save();
            //
            return redirect()->route('panel-inventario')->with(array(
                "message" => "Se marco como último inventario 2021"
            ));
        }
    }
    public function inventario_detalle($area_id){
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

        /* Revisión con Nota*/
        $total_equipos_revision = DB::table('inventariodetalle')
            ->select(DB::raw('COUNT(*) as revisiones'))
            ->where('estatus', '=', 'Revision')
            ->where('IdArea', '=', $area_id)
            ->first();

        /*AREAS*/
        $origen ='inventario-area';

        /*DATA TABLE*/
        $equipos = VsEquipo::where('id_area','=',$area_id)->get();
        $total_equipos = count($equipos);

        //Cargar vista vs_equipos_detalles
        $equipos_detalle = Vs_Equipo_Detalle::where('id_area','=',$area_id)->get();

        return view('inventario.inventario_detalle')
            ->with('total_equipos',$total_equipos)
            ->with('total_equipos_localizados',$total_equipos_localizados)
            ->with('total_equipos_revision',$total_equipos_revision)
            ->with('equipos',$equipos)
            ->with('equipos_en_sici', $equipos_en_sici)
            ->with('equipos_en_sici_localizados', $equipos_en_sici_localizados)
            ->with('equipos_en_sici_no_localizados', $equipos_en_sici_no_localizados)
            ->with('origen', $origen)
            ->with('equipos_detalle',$equipos_detalle);
    }

}

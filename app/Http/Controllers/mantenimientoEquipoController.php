<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Equipo;
use App\Models\Empleado;
use App\Models\VsEquipo;
use App\Models\VsPrestamo;
use App\Models\Proyecto;
use App\Models\EquipoPorPrestamo;
use App\Models\InventarioDetalle;
use App\Models\VsEquiposPorTicket;
use App\Models\VsTicket;
use App\Models\expediente;
use App\Models\MovimientoEquipo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class mantenimientoController extends Controller
{
    public function index()
    {   
        
    }

        public function show($id)
    {
        //
    }


    public function store(Request $request)
    {
        $validateData = $this->validate($request,[
            'equipo_id'=>'required',
            'fecha'=>'required',
            'detalles'=>'required',
        ]);
        $mantenimientos_equipos = new mantenimientos_equipos();
        $mantenimientos_equipos->equipo_id = $request->input('equipo_id');
        $mantenimientos_equipos->fecha = $request->input('fecha');
        $mantenimientos_equipos->detalles = $request->input('detalles');
       
	$mantenimientos_equipos->save();
       
	//
        $log = new Log();
        $log->tabla = "mantenimientos_equipos";
        $mov="";
        $mov=$mov." id_equipo:". $mantenimientos_equipos->equipo_id." fecha:". $mantenimientos_equipos->fecha." Detalles: ". $mantenimientos_equipos->detalles;
        $log->movimiento = $mov;
        $log->usuario_id = Auth::user()->id;
        $log->acciones = "Insercion";
        $log->save();
        //
        return redirect('expediente/'.$request->input('equipo_id'))->with(array(
            'message'=>'El mantenimiento se guardo Correctamente'
        ));
    }

}

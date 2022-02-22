<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Equipo;
use App\Models\Empleado;
use App\Models\VsEquipo;
use App\Models\VsPrestamo;
use App\Models\EquipoPorPrestamo;
use App\Models\InventarioDetalle;
use App\Models\VsEquiposPorTicket;
use App\Models\VsTicket;
use App\Models\MovimientoEquipo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Ip;


class EquipoController extends Controller
{
    public function index()
    {



    }


    public function create()
    {
        $empleados = Empleado::all()->sortBy('nombre');
        $areas = Area::all();
	$tipo_equipos = Equipo::distinct()->orderby('tipo_equipo','asc')->get(['tipo_equipo']);
	$ip = Ip::select('ip')->where('disponible','=','si')->get();
        return view('equipo.create')->with('empleados', $empleados)->with('areas', $areas)->with('tipo_equipos', $tipo_equipos)->with('ips',$ip);
    }

    public function store(Request $request)
    {
        $validateData = $this->validate($request,[
            'udg_id'=>'required',
            'tipo_equipo'=>'required',
            'marca'=>'required',
            'modelo'=>'required',
            'numero_serie'=>'required',
            'mac'=>'required',
            'ip'=>'required',
            'tipo_conexion'=>'required',
            'detalles'=>'required'
            ]);
        $equipo = new equipo();
	$equipo_ip = $equipo->ip;
        $equipo->udg_id = $request->input('udg_id');
        $equipo->tipo_equipo = $request->input('tipo_equipo');
        $equipo->marca = $request->input('marca');
        $equipo->modelo = $request->input('modelo');
        $equipo->numero_serie = $request->input('numero_serie');
        $equipo->mac = $request->input('mac');
        $equipo->ip = $request->input('ip');
	$equipo->tipo_conexion = $request->input('tipo_conexion');
        $equipo->detalles = $request->input('detalles');
        $equipo->id_resguardante = $request->input('id_resguardante');
	$equipo->resguardante = $request->input('resguardante');
        $equipo->localizado_sici = $request->input('localizado_sici');
        $equipo->save();
/*
	//return $request->input('ip');
	$ip = Ip::where('ip','=',$request->input('ip'))->get()[0];

	if($ip->ip != $equipo_ip ){
		$ip->disponible = 'no';
		$ip->save();
		$ip_vieja = Ip::where('ip','=',$equipo_ip)->get()[0];
		$ip_vieja->disponible = 'si';
		$ip_vieja->update();
	}	
	*/


	$ultimo_id_equipo = $equipo->id;
	$movimiento_equipo = new MovimientoEquipo;
	$movimiento_equipo->id_equipo = $ultimo_id_equipo;
	$movimiento_equipo->id_area = $request->input('id_area');
	$movimiento_equipo->id_usuario = $request->input('id_resguardante');
	$movimiento_equipo->registro = 'Alta de equipo';
	$movimiento_equipo->fecha = now();
	$movimiento_equipo->comentarios = 'Alta equipo';
	$movimiento_equipo->save();
	
	//
        $log = new Log();
        $log->tabla = "equipos";
        $mov="";
        $mov=$mov." udg_id:".$equipo->udg_id ." tipo_equipo:". $equipo->tipo_equipo ." marca:" .$equipo->marca;
        $mov=$mov." modelo:".$equipo->modelo ." numero_serie:". $equipo->numero_serie ." mac:" .$equipo->mac;
        $mov=$mov." ip:".$equipo->ip ." tipo_conexion:". $equipo->tipo_conexion ." detalles:" .$equipo->detalles;
        $mov=$mov." id_resguardante:".$equipo->id_resguardante ." resguardante:". $equipo->resguardante ." localizado_sici:" .$equipo->localizado_sici;
        $log->movimiento = $mov;
        $log->usuario_id = Auth::user()->id;
        $log->acciones = "Insercion";
        $log->save();
        //
        return redirect('home')->with(array(
            'message'=>'El equipo se guardo Correctamente'
        ));
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $empleados = Empleado::all()->sortBy('nombre');
	$tipo_equipos = Equipo::distinct()->orderby('tipo_equipo','asc')->get(['tipo_equipo']);
	$ip = Ip::select('ip')->where('disponible','=','si')->get();

        $equipo = VsEquipo::find($id);
        if($equipo){
            $idResguardante=$equipo->id_resguardante;
            if($idResguardante==0){
                $idResguardante=39;
            }
            $resguardante = Empleado::find($idResguardante);
            return view('equipo.edit')->with('equipo', $equipo)->with('empleados', $empleados)->with('resguardante',$resguardante)->with('tipo_equipos', $tipo_equipos)->with('ips',$ip);
        }else{
            return redirect('home')->with(array(
                'message'=>'El Id que desea modificar no existe'
            ));
        }


    }


    public function update(Request $request, $id)
    {
        $validateData = $this->validate($request,[
            'udg_id'=>'required',
            'tipo_equipo'=>'required',
            'marca'=>'required',
            'modelo'=>'required',
            'numero_serie'=>'required',
            'mac'=>'required',
            'ip'=>'required',
            'tipo_conexion'=>'required',
            'detalles'=>'required'
        ]);
        $equipo = Equipo::find($id);
	$equipo_ip = $equipo->ip;
        $equipo->udg_id = $request->input('udg_id');
        $equipo->tipo_equipo = $request->input('tipo_equipo');
        $equipo->marca = $request->input('marca');
        $equipo->modelo = $request->input('modelo');
        $equipo->numero_serie = $request->input('numero_serie');
        $equipo->mac = $request->input('mac');
        $equipo->ip = $request->input('ip');
        $equipo->tipo_conexion = $request->input('tipo_conexion');
        $equipo->detalles = $request->input('detalles');
        $equipo->id_resguardante = $request->input('id_resguardante');
	$equipo->resguardante = $request->input('resguardante');
        $equipo->localizado_sici = $request->input('localizado_sici');
	$equipo->update();

	if($request->input('ip') != 'No Especificado'){
	$ip = Ip::where('ip','=',$request->input('ip'))->get()[0];
	if($ip->ip != $equipo_ip ){
		$ip->disponible = 'no';
		$ip->save();
		if($equipo_ip != 'No Especificado'){
			$ip_vieja = Ip::where('ip','=',$equipo_ip)->get()[0];
			$ip_vieja->disponible = 'si';
			$ip_vieja->update();
		}
	}	
	}else{
		if($equipo_ip != 'No Especificado'){
			$ip_vieja = Ip::where('ip','=',$equipo_ip)->get()[0];
			$ip_vieja->disponible = 'si';
			$ip_vieja->update();
		}
	}	
	
	//
        $log = new Log();
        $log->tabla = "equipos";
        $mov="";
        $mov=$mov." udg_id:".$equipo->udg_id ." tipo_equipo:". $equipo->tipo_equipo ." marca:" .$equipo->marca;
        $mov=$mov." modelo:".$equipo->modelo ." numero_serie:". $equipo->numero_serie ." mac:" .$equipo->mac;
        $mov=$mov." ip:".$equipo->ip ." tipo_conexion:". $equipo->tipo_conexion ." detalles:" .$equipo->detalles;
        $mov=$mov." id_resguardante:".$equipo->id_resguardante ." resguardante:". $equipo->resguardante ." localizado_sici:" .$equipo->localizado_sici;
        $log->movimiento = $mov;
        $log->usuario_id = Auth::user()->id;
        $log->acciones = "Edicion";
        $log->save();
        //
        return redirect('home')->with(array(
            'message'=>'El equipo se actualizó correctamente'
        ));
    }


    public function destroy($id)
    {
        //
    }


    public function revisionInventario(){
        return view('equipo.revision-inventario');
    }
    public function busquedaAvanzada(){
        return view('equipo.busquedaAvanzada');
    }
    public function busqueda(Request $request){
        $validateData = $this->validate($request,[
           'busqueda'=>'required'
           ]);

       $busqueda = $request->input('busqueda');
       if(isset($busqueda) && !is_null($busqueda)){
           $vsequipos = VsEquipo::where('activo','=',1)
               ->where('id','=',$busqueda)
               ->orWhere('udg_id','LIKE','%'.$busqueda.'%')
               ->orWhere('marca','LIKE','%'.$busqueda.'%')
               ->orWhere('modelo','LIKE','%'.$busqueda.'%')
               ->orWhere('numero_serie','LIKE','%'.$busqueda.'%')
               ->orWhere('mac','LIKE','%'.$busqueda.'%')
               ->orWhere('ip','LIKE','%'.$busqueda.'%')
	       ->orWhere('detalles','LIKE','%'.$busqueda.'%')
               ->orWhere('tipo_conexion','LIKE','%'.$busqueda.'%')
               ->orWhere('tipo_equipo','LIKE','%'.$busqueda.'%')
               ->orWhere('area','LIKE','%'.$busqueda.'%')->get();
		
	   $equipos = $this->cargarDT($vsequipos );

           return view('equipo.busqueda')->with('equipos',$equipos)->with('busqueda', $busqueda);
       }else{
           return redirect('home')->with(array(
               'message'=>'Debe introducir un término de búsqueda'
           ));
       }

    }
    public function busquedaEquiposTicket(Request $request){
        $validateData = $this->validate($request,[
            'busqueda'=>'required'
        ]);

        $busqueda = $request->input('busqueda');
        $ticket_id = $request->input('ticket_id');
        $ticket = VsTicket::find($ticket_id);
        if(isset($busqueda) && !is_null($busqueda)){
            $equipos = VsEquipo::where('id','=',$busqueda)
                ->orWhere('udg_id','LIKE','%'.$busqueda.'%')
                ->orWhere('marca','LIKE','%'.$busqueda.'%')
                ->orWhere('marca','LIKE','%'.$busqueda.'%')
                ->orWhere('modelo','LIKE','%'.$busqueda.'%')
                ->orWhere('numero_serie','LIKE','%'.$busqueda.'%')
                ->orWhere('mac','LIKE','%'.$busqueda.'%')
                ->orWhere('ip','LIKE','%'.$busqueda.'%')
                ->orWhere('tipo_conexion','LIKE','%'.$busqueda.'%')
                ->orWhere('tipo_equipo','LIKE','%'.$busqueda.'%')
                ->orWhere('area','LIKE','%'.$busqueda.'%')->get();
            $equipoPorTickets = VsEquiposPorTicket::where('ticket_id','=', $ticket_id)->get();
            return view('ticket.agregarEquiposTicket')->with('equipos',$equipos)->with('busqueda', $busqueda)
                ->with('ticket', $ticket)->with('ticket_id', $ticket_id)->with('equipoPorTickets', $equipoPorTickets);
        }else{
            return redirect('home')->with(array(
                'message'=>'Debe introducir un término de búsqueda'
            ));
        }

    }

public function busquedaEquiposPrestamo(Request $request){
        $validateData = $this->validate($request,[
            'busqueda'=>'required'
        ]);

        $busqueda = $request->input('busqueda');
        $prestamo_id = $request->input('prestamo_id');
        $prestamo = VsPrestamo::find($prestamo_id);
        if(isset($busqueda) && !is_null($busqueda)){
            $equipos = VsEquipo::where('id','=',$busqueda)
                ->orWhere('udg_id','LIKE','%'.$busqueda.'%')
                ->orWhere('marca','LIKE','%'.$busqueda.'%')
                ->orWhere('marca','LIKE','%'.$busqueda.'%')
                ->orWhere('modelo','LIKE','%'.$busqueda.'%')
                ->orWhere('numero_serie','LIKE','%'.$busqueda.'%')
                ->orWhere('mac','LIKE','%'.$busqueda.'%')
                ->orWhere('ip','LIKE','%'.$busqueda.'%')
                ->orWhere('tipo_conexion','LIKE','%'.$busqueda.'%')
                ->orWhere('tipo_equipo','LIKE','%'.$busqueda.'%')
                ->orWhere('area','LIKE','%'.$busqueda.'%')->get();
            $equipoPorPrestamo = EquipoPorPrestamo::where('id_prestamo','=', $prestamo_id)->get();
            return view('prestamo.agregarEquiposPrestamo')->with('equipos',$equipos)->with('busqueda', $busqueda)
                ->with('prestamo', $prestamo )->with('prestamo_id', $prestamo_id)->with('equipoPorPrestamo', $equipoPorPrestamo);
        }else{
            return redirect('home')->with(array(
                'message'=>'Debe introducir un término de búsqueda'
            ));
        }

    }
    
    public function inventario_cta(){
        //Se hace la ruta, la ruta manda llamar el método y el método manda llamar la plantilla
        $vsequipos = VsEquipo::where('activo', '=', 1)
            ->Where('resguardante', '=', 'CTA')->get();
	$equipos = $this->cargarDT($vsequipos );
        return view('equipo.inventariocta', array(
            'equipos' => $equipos

        ));

    }

    public function cargarDT($consulta)
    {
        $equipos = [];

        foreach ($consulta as $key => $value){
           
            $cambiarubicacion = route('cambiar-ubicacion', $value['id']);
            $actualizar =  route('equipos.edit', $value['id']);
            $prestamo = route('generar-prestamo', $value['id']);
	    $historial = route('historial', $value['id']);
	    $ruta = "eliminar".$value['id'];
            $eliminar = route('delete-equipo', $value['id']);
            if(Auth::user()->role != 'general') {
                $acciones = '
			<div class="btn-acciones">
                    	    <div class="btn-circle">
				<a href="' . $actualizar . '" title="Actualizar">                          
				<span class="text-success"><span class="material-icons">edit</span></span>
                        	</a>
                        	<a href="' . $prestamo . '"  title="Prestamo">
                            	<span class="text-info"><span class="material-icons">feed</span></span>
                        	</a>
				<a href="' . $cambiarubicacion . '"  title="Reubicar">
                            	<span class="text-danger"><span class="material-icons">location_on</span></span>                        
				</a>
				<a href="' . $historial . '"  title="Historial">
                            	<span class="text-secondary"><span class="material-icons">history</span></span>                        
				</a>
				<a href="#' . $ruta . '" role="button" class="btn btn-danger" data-toggle="modal" title="Eliminar">
                            	<i class="far fa-trash-alt"></i>
                        	</a>
			     </div>
                	</div>

			<div class="modal fade" id="' . $ruta . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               		    <div class="modal-dialog" role="document">
                               <div class="modal-content">
                                  <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar este equipo?</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        	       <span aria-hidden="true">&times;</span>
                                       </button>
                                 </div>
                    		 <div class="modal-body">
		                    <p class="text-primary">
                		      <small> 
                                          Marca: ' . $value['marca'] . ', Modelo:' . $value['modelo'] . ', N/S: ' . $value['numero_serie'] . '
		                      </small>
                     	 	   </p>
                    		 </div>
	                         <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		                    <a href="' . $eliminar . '" type="button" class="btn btn-danger">Eliminar</a>
                    		 </div>
                  	      </div>
                	    </div>
              		</div>             
            ';
            }
		$localizado_en_sici='';
		if($value['resguardante']=='CTA'){
                                
                                if($value['localizado_sici']=='Si')
                                     $localizado_en_sici.='Localizado';
                                else
                                    $localizado_en_sici.='No localizado';
                                
                }
        if(Auth::user()->role != 'general'){
            $equipos[$key] = array(
                $acciones,
                $value['id'],
                $value['udg_id'],
                $value['tipo_equipo'],
                $value['marca'],
                $value['modelo'],
                $value['numero_serie'],
                $value['detalles'].' SICI: '.$localizado_en_sici,
                $value['area']
            );
        }else{
            $equipos[$key] = array(
                $value['id'],
                $value['udg_id'],
                $value['tipo_equipo'],
                $value['marca'],
                $value['modelo'],
                $value['numero_serie'],
                $value['detalles'].' SICI: '.$localizado_en_sici,
                $value['area']
            );
        }


        }

        return $equipos;
    }

    public function delete_equipo($equipo_id){
        
        $equipo = Equipo::find($equipo_id);

        if($equipo){

            $equipo->activo = 0;
            $equipo->update();
	     //
            $log = new Log();
        $log->tabla = "Equipos";
        $mov="";
        $mov=$mov."Eliminaci�n l�gica del Equipo: ".$equipo_id;
        $log->movimiento = $mov;
        $log->usuario_id = Auth::user()->id;
        $log->acciones = "Borrrado";
        $log->save();
        //

            return redirect()->route('home')->with(array(
                "message" => "El equipo se ha eliminado correctamente"
            ));

        }else{

            return redirect()->route('home')->with(array(
                "message" => "El equipo que trata de eliminar no existe"
            ));
        }

    }


}

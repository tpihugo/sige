<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Equipo;
use Illuminate\Http\Request;
use App\Models\EquipoPorPrestamo;
use App\Models\PrestamoEquipo;
use App\Models\MovimientoEquipo;
use App\Models\Prestamo;
use App\Models\VsPrestamo;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $vsprestamos = VsPrestamo::where('activo','=',1)
            ->where('estado','En préstamo')->get();
          $prestamos = $this->cargarDT($vsprestamos);

        $consultaAlumnos = VsPrestamo::where('activo','=',1)
        ->where('estado','En préstamo')->where('cargo','Alumno')->get();

        $consultaAdministracion = VsPrestamo::where('activo','=',1)
        ->where('estado','En préstamo')->where('cargo','Administrativo')->get();
       
       

       // dd($prestamos);
        return view('prestamo.index')->with('prestamos',$prestamos);
    
    }

    public function reporte($consulta){ 
        $prestamos = [];
        $cargo =[];
        foreach ($consulta as $key => $value){
        $prestamos[$key] = array(
            $value['id'],
            $value['solicitante'],
            $value['carrera'],
            $value['lugar'],
            $value['contacto'],
            $value['fecha_actualizacion'] = \Carbon\Carbon::parse($value->fecha_actualizacion)->format('d/m/Y H:i'),
            $value['observaciones']
        );


        }   

        return $prestamos ;
     }


     public function ReporteAdministracion(){
        $consultaAlumnos =  VsPrestamo::where('activo','=',1)
        ->where('estado','En préstamo')->where('cargo','Administrativo')->get();
        $reporte = $this->reporte($consultaAlumnos);
        $cargo = "Administración";
        return view('prestamo.reportes', compact('reporte','cargo'));
    }

    public function ReporteAlumno(){
        $consultaAlumnos =  VsPrestamo::where('activo','=',1)
        ->where('estado','En préstamo')->where('cargo','Alumno')->get();
        $reporte = $this->reporte($consultaAlumnos);
        $cargo = "Alumno";
        return view('prestamo.reportes', compact('reporte','cargo'));
    }

//-------------------------------------
    public function VerEquipos($consulta){

        //$consulta->id
        $equiposPorPrestamo = EquipoPorPrestamo::where('id_prestamo','=', $consulta->id)->get();
        $consulta = $equiposPorPrestamo;
        //dd($consulta);
        return  $consulta;
            
    }

    public function BuscadorEquipos(Request $request)
    {
        $id = $request->id; 
         
        $equiposPorPrestamo = EquipoPorPrestamo::where('id_prestamo','=', $id)->get();

        return view('prestamo.equipos-tabla', compact('equiposPorPrestamo'))->render();
    }

    public function agregarEquipos_prestamoExistente($id)
    {
        return redirect('prestamos/'.$id);
    }

    
    public function fechas_prestamos()
    {
        $fechaHoy = Carbon::now()->parse()->format('Y');

        $vsprestamos = VsPrestamo::where('activo','=',1)
        ->where('estado','En préstamo')->get();

        $prestamos_expirados = $this->reenovarFecha_Prestamo($vsprestamos);

        $cargo_Alumno = Prestamo::where('activo','=',1)->where('estado','En préstamo')->where('cargo','=','Alumno')->count(); 
        $cargo_Administracion = Prestamo::where('activo','=',1)->where('estado','En préstamo')->where('cargo','=','Administrativo')->count();
        $cargo_Academico = Prestamo::where('activo','=',1)->where('estado','En préstamo')->where('cargo','=','Academico')->count();
        
        $cargo_Todo =  Prestamo::where('activo','=',1)->where('estado','En préstamo')->count();

        $calculo_Otro =  $cargo_Todo - $cargo_Alumno - $cargo_Administracion - $cargo_Academico;

        return view('prestamo.fecha-prestamos')->with('expirados',$prestamos_expirados)->with('cargo_Alumno',$cargo_Alumno)
        ->with('cargo_Administracion',$cargo_Administracion)->with('cargo_Academico',$cargo_Academico)->with('calculo_Otro',$calculo_Otro)->with('fechaHoy',$fechaHoy);
    }

    public function Fechas_diagrama($request){
        $prestamosFechas_array = [];

        for($i = 0, $mes = 1 ; $i <= 11; $i++, $mes++){
                $prestamosEquipos_array[] = array(
                    $prestamosFechas_array[$i] = Prestamo::where('activo','=',1)->whereMonth('fecha_inicio', $mes)->whereYear('fecha_inicio',  $request)->count()
                  );
        }

        return view('prestamo.diagrama-prestamos', compact( 'prestamosFechas_array'))->render();

}


    public function reenovarFecha_Prestamo($vsprestamos){
        
        $prestamosEquipos_array_noti = [];
        $count = 0; 

        foreach($vsprestamos as $key => $value){
               
            $verEquipos=
            '
            <p><a onclick=logKey('.$value['id'].') class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#exampleModal" style="color: rgb(7,189,212)">Ver mas</a></p>                                                      
            '
            ;
            $ruta = "reenovarPrestamo".$value['id'];    
            $reenovarPrestamo = route('reenovarPrestamo', $value['id']);

            $acciones = '';
            $acciones = '     
            <div class="btn-acciones">
            <div> 
                <a href="#'.$ruta.'" role="button" class="btn btn-success" data-toggle="modal" title="Renovar">
                <i class="fas fa-history"></i>
                </a>
            </div>    
            </div>

            <div class="modal fade" id="'.$ruta.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas renovar este préstamo?</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p class="text-primary">
                    <small> 
                            <h2 class="card-title"><span class="text-info"><i class="fas fa-file-alt"></span></i> Folio: '.$value['id'].'</h2> 
                            <br><br>
                            <h3 class="card-title"><span class="text-success"><i class="fas fa-user"></span></i> '.$value['solicitante'].'</h3> 
                            <br> 

                            <h3 style="display: none"> '.$value['lista_equipos'].'</h3>
                    </small>

                  </p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <a href="'.$reenovarPrestamo.'" type="button" class="btn btn-info">Renovar</a>
                </div>
              </div>
            </div>
          </div>
            ';
                $fechaInicio = $value->fecha_inicio;
                $fechaActualizacion = $value->fecha_actualizacion;
                $fechaActualizacion2 = \Carbon\Carbon::parse($fechaActualizacion)->format('Y/m/d');

                //$fechaProxima = \Carbon\Carbon::parse($fechaInicio)->addMonths(5)->format('Y/m/d');

               $fechaActual_prestamo = Carbon::now()->parse()->format('Y/m/d');
               
                    if($fechaInicio == $fechaActualizacion2 ){
                        $fechaProxima = \Carbon\Carbon::parse($fechaInicio)->addMonths(6)->format('Y/m/d');
                    }else{
                        if($fechaActualizacion2 > $fechaInicio){
                            $fechaProxima = \Carbon\Carbon::parse($fechaActualizacion2)->addMonths(6)->format('Y/m/d');
                        }
                    }

                    if( $fechaActual_prestamo > $fechaProxima){

                        $prestamosEquipos_array_noti[$count++] = array(
                            $value['id'],
                            $value['solicitante'],
                            $value['cargo'],
                            $value['lugar'],
                            $value['contacto'],
                            $value['estado'],
                            $verEquipos, 
                            $value['fecha_inicio'],
                            $value['observaciones'],
                            $acciones
                            //$value['observaciones']
                        );
                    }
                    
                } 
            
                //dd($prestamosEquipos_array);
                return $prestamosEquipos_array_noti;
    }


    public function reenovar_prestamo($prestamo_id){
        $prestamo = Prestamo::find($prestamo_id);
        if($prestamo){
            $prestamo->activo = 1;
            $prestamo->fecha_actualizacion = Carbon::now();
            $prestamo->update();
	    //
            $log = new Log();
            $log->tabla = "Prestamo";
            $mov="";
            $mov=$mov." id_area:".$prestamo->id_area ." telefono:". $prestamo->telefono ." solicitante" .$prestamo->solicitante;
            $mov=$mov." correo:".$prestamo->correo ." cargo:". $prestamo->cargo ." estado:". $prestamo->estado ;
            $mov=$mov." fecha_inicio:".$prestamo->fecha_inicio ." observaciones:". $prestamo->observaciones . ".";
            $log->movimiento = $mov;
            $log->usuario_id = Auth::user()->id;
            $log->acciones = "Renovación de préstamo";
            $log->save();
            //
            return redirect()->route('fechas_prestamos')->with(array(
                "message" => "El prestamo se ha renovado correctamente"
            ));
        }else{
            return redirect()->route('fechas_prestamos')->with(array(
                "message" => "El prestamo que trata de renovar no existe"
            ));
        }
    }




    public function cargarDT($consulta)
    {
        $prestamos = [];

        foreach ($consulta as $key => $value){

        $ruta = "borrarPrestamo".$value['id'];    
        $cambiarubicacion = route('cambiar-ubicacion', $value['id']);
        $actualizar =  route('prestamos.edit', $value['id']);
	    $prestamo = route('imprimirPrestamo', $value['id']);
        $prestamo_contrato = route('imprimirContrato', $value['id']);
        $borrarPrestamo = route('borrarPrestamo', $value['id']);
        $devolverPrestamo = route('devolverPrestamo', $value['id']); 

        $acciones = '';

       $imprimir_prestamo = '
       <a href="'.$prestamo.'" class="btn btn-primary btn-sm m-1"  title="Formato de Préstamo" target="_blank">
       <i class="far fa-file-alt"></i>
       </a>
       ';
       $imprimir_contrato = '
       <a href="'.$prestamo_contrato.'" class="btn btn-info btn-sm m-1"  title="Formato de Contrato" target="_blank">
       <i class="far fa-file-alt"></i>
       </a>
       ';

     
        if($value->cargo == 'Alumno'){
                $formato = $imprimir_contrato;
            }else{
                $formato = $imprimir_prestamo;
            }


        if($value['lista_equipos'] != null){
            $verEquipos=
            '
            <p><a onclick=logKey('.$value['id'].') class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#exampleModal" style="color: rgb(7,189,212)">Ver mas</a></p>                                                      
            '
            ;
        
        }else{
            $verEquipos=
            '<center>
            <p>Sin equipos seleccionados</p>                                                      
            </center>
            '
            ;
        }

        $acciones = '
            <div class="btn-acciones">
                <div class="btn-circle">
                    <a href="'.$actualizar.'" class="btn btn-success btn-sm m-1" title="Actualizar">
                        <i class="far fa-edit"></i>
                    </a>

                    '.$formato.' 

                </div>
            </div>
                <div class="btn-acciones">
                <div class="btn-circle">
                    <a href="#'.$ruta.'" role="button" class="btn btn-danger btn-sm m-1" data-toggle="modal" title="Eliminar">
                            <i class="far fa-trash-alt"></i>
                    </a>
                    <a href="'.$devolverPrestamo.'" class="btn btn-success btn-sm m-1"  title="Devolución de Préstamo">
                    <i class="fas fa-check"></i>
                    </a>
                </div>    
                </div>
            </div>
            <div class="modal fade" id="'.$ruta.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar este préstamo?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p class="text-primary">
                        <small>
                            '.$value['id'].',<br> '.$value['solicitante'].'
                        </small>
                        <small><br><br>
                        '.$value['lista_equipos'].'
                        </small>
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <a href="'.$borrarPrestamo.'" type="button" class="btn btn-danger">Eliminar</a>
                    </div>
                  </div>
                </div>
              </div>
        ';

        $prestamos[$key] = array(
            $value['id'],
            $value['solicitante'],
            $value['cargo'],
            $value['lugar'],
            $value['contacto'],
            $value['estado'],
            $verEquipos ,
            $value['fecha_actualizacion'] = \Carbon\Carbon::parse($value->fecha_actualizacion)->format('d/m/Y H:i'),
            $value['observaciones'],
            $acciones 
        );

       // dd($prestamos, $value['prestamo']->id);

// and $value['prestamo']
        }

        //dd($verEquipos, $value, $prestamos);
        
        return $prestamos ;

     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prestamos.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $this->validate($request,[
            'id_area'=>'required',
            'solicitante'=>'required',
            'cargo'=>'required',
            'estado'=>'required',
            'fecha_inicio'=>'required',
            'observaciones'=>'required'
        ]);
        $prestamo = new Prestamo();
        $prestamo->id_area = $request->input('id_area');
        $prestamo->telefono = $request->input('telefono');
        $prestamo->solicitante = $request->input('solicitante');
        $prestamo->correo = $request->input('correo');
        $prestamo->cargo = $request->input('cargo');
        $prestamo->carrera = $request->input('carrera');
        $prestamo->estado = $request->input('estado');
        $prestamo->fecha_inicio = $request->input('fecha_inicio');
        $prestamo->observaciones = $request->input('observaciones');

	    $prestamo->save();

        $lastPrestamo = $prestamo->id;

        $prestamo_equipo = new PrestamoEquipo();
        $prestamo_equipo->id_prestamo = $lastPrestamo;
        $prestamo_equipo->id_equipo = $request->input('equipo_id');
        $prestamo_equipo->accesorios = $request->input('accesorios');
        $prestamo_equipo->save();

        $log = new Log();
        $log->tabla = "Prestamo_y_PrestamoEquipo";
        $mov="";
        $mov=$mov." id_area:".$prestamo->id_area ." telefono:". $prestamo->telefono ." solicitante" .$prestamo->solicitante." carrera:".$prestamo->carrera;
        $mov=$mov." correo:".$prestamo->correo ." cargo:". $prestamo->cargo ." estado:". $prestamo->estado ;
        $mov=$mov." fecha_inicio:".$prestamo->fecha_inicio ." observaciones:". $prestamo->observaciones;
        $mov=$mov." id_prestamo:".$prestamo_equipo->id_prestamo ." id_equipo:". $prestamo_equipo->id_equipo." accesorios:". $prestamo_equipo->accesorios .".";
        $log->movimiento = $mov;
        $log->usuario_id = Auth::user()->id;
        $log->acciones = "Insercion";
        $log->save();
        //
        return redirect('prestamos')->with(array(
            'message'=>'El prestamo se guardo Correctamente'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prestamo = VsPrestamo::find($id);
        $equiposPorPrestamo = EquipoPorPrestamo::where('id_prestamo','=',$id)->get();
        return view('prestamo.agregarEquipoEdit')
            ->with('prestamo', $prestamo)->with('equiposPorPrestamo', $equiposPorPrestamo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prestamo = Prestamo::find($id);
        $vsPrestamo = VsPrestamo::find($id);
        $equiposPrestados = EquipoPorPrestamo::where('id_prestamo','=',$id)
            ->where('activo','=',1)->get();

        $areas = Area::all();
        return view('prestamo.edit')->with('prestamo',$prestamo)->with('vsPrestamo',$vsPrestamo)->with('equiposPrestados',$equiposPrestados)->with('areas',$areas);
    }

    ////////////////////////////////////////////////////////////////



    public function update(Request $request, $id)
    {
        $validateData = $this->validate($request,[
            'id_area'=>'required',
            'solicitante'=>'required',
            'cargo'=>'required',
            'estado'=>'required',
            'fecha_inicio'=>'required',
            'observaciones'=>'required'
        ]);
        $prestamo = Prestamo::find($id);
        $prestamo->id_area = $request->input('id_area');
        $prestamo->telefono = $request->input('telefono');
        $prestamo->solicitante = $request->input('solicitante');
        $prestamo->correo = $request->input('correo');
        $prestamo->cargo = $request->input('cargo');
        $prestamo->estado = $request->input('estado');
        $prestamo->fecha_inicio = $request->input('fecha_inicio');
        $prestamo->observaciones = $request->input('observaciones');
        $documento = $request->file('documento');

        $prestamo_id = $prestamo->id;
        if($documento){
            if($prestamo->cargo == 'Alumno'){
                $documento_path = (string)date('d-m-Y')."_".$prestamo_id.$documento->getClientOriginalName();
                \Storage::disk('contratos')->put($documento_path, \File::get($documento));
                $prestamo->documento = $documento_path;
            }else{
                $documento_path = (string)date('d-m-Y')."_".$prestamo_id.$documento->getClientOriginalName();
                \Storage::disk('prestamos')->put($documento_path, \File::get($documento));
                $prestamo->documento = $documento_path;
            }
    }
        $prestamo->update();
	//
        $log = new Log();
        $log->tabla = "Prestamo";
        $mov="";
        $mov=$mov." id_area:".$prestamo->id_area ." telefono:". $prestamo->telefono ." solicitante" .$prestamo->solicitante;
        $mov=$mov." correo:".$prestamo->correo ." cargo:". $prestamo->cargo ." estado:". $prestamo->estado ;
        $mov=$mov." fecha_inicio:".$prestamo->fecha_inicio ." observaciones:". $prestamo->observaciones . ".";
        $log->movimiento = $mov;
        $log->usuario_id = Auth::user()->id;
        $log->acciones = "Edicion";
        $log->save();
        //
        return redirect('prestamos')->with(array(
            'message'=>'El préstamo se guardo Correctamente'
        ));
    }


    public function destroy($id)
    {

    }
    public function generarPrestamo($equipo_id){
        $areas = Area::where('activo','=', 1)->get();
        $equipoPrestamo = Equipo::find($equipo_id);
        return view('prestamo.create')->with('areas', $areas)->with('equipoPrestamo', $equipoPrestamo);
    }

    ///---------------------------------------------------------------------


    public function quitarEquipoPrestado($equipo_prestado_id, $prestamo_id){

        $equipoPrestado = PrestamoEquipo::find($equipo_prestado_id);
        $equipoPrestado->activo = 0;
        $equipoPrestado->update();


	//
        $log = new Log();
        $log->tabla = "PrestamoEquipo";
        $mov="";
        $mov=$mov." id_prestamo:".$equipoPrestado->id_prestamo ." id_equipo:". $equipoPrestado->id_equipo." accesorios:". $equipoPrestado->accesorios.".";
        $log->movimiento = $mov;
        $log->usuario_id = Auth::user()->id;
        $log->acciones = "Borrado";
        $log->save();
        //
        return view('home');
    }
    public function delete_prestamo($prestamo_id){
        $prestamo = Prestamo::find($prestamo_id);
        if($prestamo){
            $prestamo->activo = 0;
            $prestamo->update();
	    //
            $log = new Log();
            $log->tabla = "Prestamo";
            $mov="";
            $mov=$mov." id_area:".$prestamo->id_area ." telefono:". $prestamo->telefono ." solicitante" .$prestamo->solicitante;
            $mov=$mov." correo:".$prestamo->correo ." cargo:". $prestamo->cargo ." estado:". $prestamo->estado ;
            $mov=$mov." fecha_inicio:".$prestamo->fecha_inicio ." observaciones:". $prestamo->observaciones . ".";
            $log->movimiento = $mov;
            $log->usuario_id = Auth::user()->id;
            $log->acciones = "Borrado";
            $log->save();
            //
            return redirect()->route('prestamos.index')->with(array(
                "message" => "El prestamo se ha eliminado correctamente"
            ));
        }else{
            return redirect()->route('home')->with(array(
                "message" => "El prestamo que trata de eliminar no existe"
            ));
        }
    }

    public function devolver_prestamo($id) {
        $prestamo = Prestamo::find($id);
        $id_prestamo = $prestamo->id;
 

    
        // dd($prestamo);
        if($prestamo){
            $prestamo->estado = 'Devuelto';
            $prestamo->update();   

           $consulta = PrestamoEquipo::where('id_prestamo','=', $id_prestamo)->get();
           $movEquipos="";
                foreach ($consulta as $resultado) {

                    $id_Equipo = $resultado->id_equipo;
 
                    $area_anterior1 = MovimientoEquipo::where('id_equipo','=',$id_Equipo)->where('registro','=','Cambio de ubicación')->orderBy('id', 'desc')->limit(1)->latest()->first();
                    $area_anterior2 = MovimientoEquipo::where('id_equipo','=',$id_Equipo)->where('registro','=','Registro Inicial en la Base de Datos')->orderBy('id', 'desc')->limit(1)->latest()->first();
                    $area_anterior3 = MovimientoEquipo::where('id_equipo','=',$id_Equipo)->where('registro','=','Traslado')->orderBy('id', 'desc')->limit(1)->latest()->first();
                    $area_anterior4 = MovimientoEquipo::where('id_equipo','=',$id_Equipo)->where('registro','=','Asignación Equipo')->orderBy('id', 'desc')->limit(1)->latest()->first();
                    $area_anterior5 = MovimientoEquipo::where('id_equipo','=',$id_Equipo)->where('registro','=','Alta de equipo')->orderBy('id', 'desc')->limit(1)->latest()->first();    

                if($area_anterior1 ==  null){
                        $valor1 = 0;
                   }else{
                    $valor1 = $area_anterior1->id;
                        $area_anterior1->registro;     
                   }
                
                if($area_anterior2 ==  null){
                        $valor2 = 0;
                    }else{
                        $valor2 = $area_anterior2->id;
                        $area_anterior2->registro;
                    }

                if($area_anterior3 ==  null){
                        $valor3 = 0;
                    }else{
                        $valor3 =  $area_anterior3->id;
                        $area_anterior3->registro;
                    }

                if($area_anterior4 ==  null){
                        $valor4 = 0;
                   }else{
                        $valor4 = $area_anterior4->id;
                        $area_anterior4->registro;
                   }

                   if($area_anterior5 ==  null){
                        $valor5 = 0;
                    }else{
                        $valor5 = $area_anterior5->id;
                        $area_anterior5->registro;     
                    }
                   
                     $prestamo_movimientos = new MovimientoEquipo();
                     $prestamo_movimientos->id_equipo = $id_Equipo;
           
               if($valor1 > $valor2 && $valor1 > $valor3 && $valor1 > $valor4 && $valor1 > $valor5){ 
                                $area = $area_anterior1->id_area; 
                }else{
                    if($valor2 > $valor1 && $valor2 > $valor3 && $valor2 > $valor4 && $valor2 > $valor5){
                                $area = $area_anterior2->id_area;  
                        }else{
                        if($valor3 > $valor1 && $valor3 > $valor2 && $valor3 > $valor4 && $valor3 > $valor5){
                                $area = $area_anterior3->id_area; 
                        }else{
                            if($valor4 > $valor1 && $valor4 > $valor2 && $valor4 > $valor3 && $valor4 > $valor5){
                                $area = $area_anterior4->id_area; 
                            }else{
                                if($valor5 > $valor1 && $valor5 > $valor2 && $valor5 > $valor3 && $valor5 > $valor4){
                                $area = $area_anterior5->id_area; 
                                }
                            }
                        }
                    }
               }       

                    $prestamo_movimientos->id_area = $area;
                //dd($area);

                     //La variable $id_usu se le asigna el valor del usuario que alla realizado inicio sesion
                     $prestamo_movimientos->id_usuario = Auth::user()->id;
             
                     $prestamo_movimientos->registro = "Devuelto";
                 
                     //$prestamo_movimientos->fecha = $lastFecha;
                     //Calculando fecha actual
                 
                     $fechaActual = Carbon::now();
                     $mostrarfecha = $fechaActual->format('Y-m-d'); 
                     $prestamo_movimientos->fecha =  $mostrarfecha; 
             
                     //Se le asigna el valor de la observaciones que tomo del prestamo
                     $lastComentario = $prestamo->observaciones;
                     $prestamo_movimientos->comentarios = $lastComentario;
         
                     $prestamo_movimientos->save();

                     $movEquipos=$movEquipos." id_equipo:".$prestamo_movimientos->id_equipo ." id_area:". $prestamo_movimientos->id_area ." id_usuario:". $prestamo_movimientos->id_usuario;
                     $movEquipos=$movEquipos." fecha:".$prestamo_movimientos->fecha ." comentarios:". $prestamo_movimientos->comentarios . ".";
      
                }

            //
            $log = new Log();
            $log->tabla = "Prestamo";
            $mov="";
            $mov=$mov." id_area:".$prestamo->id_area ." telefono:". $prestamo->telefono ." solicitante" .$prestamo->solicitante;
            $mov=$mov." correo:".$prestamo->correo ." cargo:". $prestamo->cargo ." estado:". $prestamo->estado;
            $mov=$mov." fecha_inicio:".$prestamo->fecha_inicio ." observaciones:". $prestamo->observaciones;
            $mov=$mov.$movEquipos . ".";
            $log->movimiento = $mov;
            $log->usuario_id = Auth::user()->id;
            $log->acciones = "Marcado como devuelto";
            
            $log->save();
            //

            return redirect()->route('prestamos.index')->with(array(
                'message'=>'El préstamo se ha cambiado de estado a devuelto Correctamente'
            ));
        }else{
            return redirect()->route('prestamos.index')->with(array(
                "message" => "El prestamo que trata de devolver no existe"
            ));
        }


    }
    public function obtenerdocumento($filename){
        $file = Storage::disk('documentos')->get($filename);
        return new Response($file, 200);
    }
    public function prestamoEquipos($prestamo_id){
        $prestamo = VsPrestamo::find($prestamo_id);
        $equiposPorPrestamo = EquipoPorPrestamo::where('id_prestamo','=', $prestamo_id)->get();
        
        return view('prestamo.agregarEquipoEdit')->with('prestamo', $prestamo )
            ->with('prestamo_id', $prestamo_id)->with('equiposPorPrestamo', $equiposPorPrestamo);
    }
    public function registrarEquipoPrestamo($equipo_id, $prestamo_id){
        $prestamoEquipo = new PrestamoEquipo();
        $prestamoEquipo->id_prestamo = $prestamo_id;
        $prestamoEquipo->id_equipo = $equipo_id;
	    //$prestamoEquipo->accesorios = $accesorios;
        $prestamoEquipo->save();

        $prestamo2 = Prestamo::where('id','=',$prestamo_id)->first();

        $prestamo2->activo = 1;

    
        $prestamo2->update();   
	//
   
        $movEquipos ="";//$prestamo_id
        $prestamo = Prestamo::where('id','=',$prestamo_id)->get();

         
      
    foreach($prestamo as $movEquiposalm){
        $prestamo_movimientos = new MovimientoEquipo();
   
        $prestamo_movimientos->id_equipo = $equipo_id;
  
        //La variable $lastArea hace referencia al id del area de Prestamo   
        $lastArea = $movEquiposalm->id_area;
        $prestamo_movimientos->id_area = $lastArea;
  
        //La variable $id_usu se le asigna el valor del usuario que alla realizado inicio sesion
        $prestamo_movimientos->id_usuario = Auth::user()->id;
  
       // $lastEstado = $prestamo->estado;
        $prestamo_movimientos->registro = "En préstamo";
        
        //Se le asigna el valor de la fecha que tomo del prestamo realizado
        //Calculando fecha actual
        
         $fechaActual = Carbon::now();
        $mostrarfecha = $fechaActual->format('Y-m-d'); 
        $prestamo_movimientos->fecha =  $mostrarfecha; 
  
        //Se le asigna el valor de la observaciones que tomo del prestamo
        $lastComentario = $movEquiposalm->observaciones;
        $prestamo_movimientos->comentarios = $lastComentario;
    

       //dd($prestamo_movimientos);
        $prestamo_movimientos->save();

        $movEquipos=$movEquipos." id_area:". $prestamo_movimientos->id_area;
        $movEquipos=$movEquipos." id_usuario:".$prestamo_movimientos->id_usuario ." registro:". $prestamo_movimientos->registro ;
        $movEquipos=$movEquipos." fecha:".$prestamo_movimientos->fecha ." comentarios:".  $prestamo_movimientos->comentarios.".";
       
    }


     
     //dd($prestamo2);
     


       

        $log = new Log();
        $log->tabla = "PrestamoEquipo";
        $mov="";
        $mov=$mov." id_prestamo:".$prestamoEquipo->id_prestamo ." id_equipo:". $prestamoEquipo->id_equipo ;
        $mov=$mov.$movEquipos .".";
        $log->movimiento = $mov;
        $log->usuario_id = Auth::user()->id;
        $log->acciones = "Insercion";
        $log->save();

        //
        return redirect('prestamos/'.$prestamo_id)->with(array(
            'message'=>'El equipo se agregó correctamente al préstamo'
        ));
    }

    public function EquipoPrestado($equipo_id){

        $equipoOcupado =  Equipo::find($equipo_id);
        $equipo = $equipoOcupado->id;

        $prestamoEquipoOcupado =  PrestamoEquipo::where('id_equipo','=', $equipo)->latest()->first();
        $id_prestamo = $prestamoEquipoOcupado->id_prestamo;

        $prestamoOcupado =  Prestamo::find($id_prestamo);
        $id_area = $prestamoOcupado->id_area;

        $busquedaArea = Area::find($id_area);
        $nombre_area = $busquedaArea->sede;

      //  dd($equipo, $id_prestamo, $prestamoOcupado);
        //return $prestamoOcupado ;
        return view('prestamo.modal',compact('prestamoOcupado'));

       // return view('prestamo.busquedaEquiposPrestamo')->with("prestamoOcupado", $prestamoOcupado);
    }


    public function eliminarEquipoPrestamo($item_id){
        $equipoPorPrestamo=PrestamoEquipo::find($item_id);
        //
        $log = new Log();
        $log->tabla = "PrestamoEquipo";
        $mov="";
        $mov=$mov." id_prestamo:".$equipoPorPrestamo->id_prestamo ." id_equipo:". $equipoPorPrestamo->id_equipo." accesorios".$equipoPorPrestamo->accesorios.".";
        $log->movimiento = $mov;
        $log->usuario_id = Auth::user()->id;
        $log->acciones = "Borrado";
        $log->save();

  
        //
        
        $prestamo_id = $equipoPorPrestamo->id_prestamo;
        $equipoPorPrestamo->delete();

        $consultaLista = VsPrestamo::where('id','=',  $prestamo_id )->first();
   
       
        if($consultaLista->lista_equipos == null){
            $prestamo2 = Prestamo::where('id','=', $prestamo_id )->first();
            $prestamo2->activo = 0;
            $prestamo2->estado = 'Devuelto';
            $prestamo2->update();   
         }
        

        $prestamo_id_area = MovimientoEquipo::where('id_equipo','=',$equipoPorPrestamo->id_equipo)->orderBy('id', 'desc')->limit(1)->latest()->first();
        $prestamo_id_area->delete();


        return redirect('prestamos/'.$prestamo_id)->with(array(
            'message'=>'El equipo se quitó  correctamente al préstamo'
        ));
    }
    
    public function nuevoPrestamo(){
        $areas = Area::where('activo','=', 1)->get();
        return view ('prestamo.nuevo')->with('areas', $areas);
        //return 'si charcha';
    }

    public function guardarPrestamo(Request $request)
    {
        $validateData = $this->validate($request,[
            'id_area'=>'required',
            'solicitante'=>'required',
            'cargo'=>'required',
            'estado'=>'required',
            'fecha_inicio'=>'required',
            'observaciones'=>'required'
        ]);
        $prestamo = new Prestamo();
        $prestamo->id_area = $request->input('id_area');
        $prestamo->telefono = $request->input('telefono');
        $prestamo->solicitante = $request->input('solicitante');
        $prestamo->correo = $request->input('correo');
        $prestamo->cargo = $request->input('cargo');

        if($request->input('carrera') == null){
            $prestamo->carrera = "-";
        }else{
            $prestamo->carrera = $request->input('carrera');
        }

        $prestamo->estado = $request->input('estado');
        $prestamo->fecha_inicio = $request->input('fecha_inicio');
        $prestamo->observaciones = $request->input('observaciones');

        $prestamo->save();
        $prestamo_id = Prestamo::latest('id')->first();

        return redirect('prestamos/'.$prestamo_id->id)->with(array(
            'message'=>'El préstamo se creó correctamente'
        ));
    }
    public function agregarAccesorio(Request $request){

        $prestamo_equipo = PrestamoEquipo::find($request->input('filaprestamo_id'));
        $prestamo_equipo->accesorios = $request->input('accesorios');
        $prestamo_equipo->update();
        
        return redirect('prestamos/'.$request->input('prestamo_id'))->with(array(
            'message'=>'El Equipo se agregó Correctamente al prestamo'
        ));
    }
    public function prestamos_all(){
        $vsprestamos = VsPrestamo::where('activo',1)->get();
        $prestamos = $this->cargarDT($vsprestamos);
        return view('prestamo.indexall')->with('prestamos', $prestamos );
    }
}
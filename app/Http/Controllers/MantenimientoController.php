<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use App\Models\Area; 
use App\Models\Tecnico; 
use App\Http\Controllers\Controller;
use App\Models\EquipoPorPrestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;
use App\Models\Vs_Relmantenimiento;
use App\Models\VsEquipo;
use App\Models\VsMantenimiento;

class MantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vsmantenimiento = VsMantenimiento::where('activo',1)->get();
        $mantenimiento = $this->cargarDT($vsmantenimiento);
        return view('mantenimiento.index')->with('mantenimientos',$mantenimiento);
    }

    public function cargarDT($consulta)
    {
        $mantenimiento = [];

        foreach ($consulta as $key => $value){

            $ruta = "eliminar".$value['id'];
            $eliminar = route('delete-mantenimiento', $value['id']);
            $actualizar =  route('mantenimiento.edit', $value['id']);

            $acciones = '
                <div class="btn-acciones">
                    <div class="btn-circle">
                        <a href="'.$actualizar.'" class="btn btn-success" title="Actualizar">
                            <i class="far fa-edit"></i>
                        </a>
                        <a href="#'.$ruta.'" role="button" class="btn btn-danger" data-toggle="modal" title="Eliminar">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </div>
                </div>
                <div class="modal fade" id="'.$ruta.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar este mantenimiento?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <a href="'.$eliminar.'" type="button" class="btn btn-danger">Eliminar</a>
                    </div>
                  </div>
                </div>
              </div>
            ';

            $mantenimiento[$key] = array(
                $acciones,
                $value['id'],
                $value['fecha_mantenimiento'],
                $value['nombre'],
                $value['telefono'],
                $value['sede'].' - '. $value['edificio'].' - '.$value['piso'].' - '.$value['division'].' - '.$value['coordinacion'].' - '.$value['area']
            );

        }

        return $mantenimiento;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::where('activo',1)->get();
        $tecnicos = Tecnico::where('activo',1)->get();
        

        return view('mantenimiento.create')->with('areas', $areas)->with('tecnicos',$tecnicos);
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
            
            'tecnico_id'=>'required',
            'area_id'=>'required',
            'fecha_mantenimiento'=>'required'
        ]);
        $mantenimiento = new Mantenimiento();
        
        $mantenimiento->tecnico_id = $request->input('tecnico_id');
        $mantenimiento->area_id = $request->input('area_id');
        $mantenimiento->fecha_mantenimiento = $request->input('fecha_mantenimiento');
	    $mantenimiento->save();

        $lastmantenimiento = $mantenimiento->id;
	//
        $log = new Log();
        $log->tabla = "mantenimientos";
        $mov="";
        $mov=$mov." id:".$mantenimiento->id ." tecnico_id:". $mantenimiento->tecnico_id ." area_id" .$mantenimiento->area_id;
        $mov=$mov." fecha_mantenimiento:".$mantenimiento->fecha_mantenimiento;
        $log->movimiento = $mov;
        $log->usuario_id = Auth::user()->id;
        $log->acciones = "Insercion";
        $log->save();
        //
        return redirect('mantenimiento/'.$lastmantenimiento)->with(array(
            'message'=>'El mantenimiento se guardó correctamente'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vsmantenimiento = VsMantenimiento::find($id);
        $relmantenimiento = Vs_Relmantenimiento::all();
        return view('mantenimiento.agregarMantenimientoEdit')
            ->with('vsmantenimiento', $vsmantenimiento)->with('relmantenimiento', $relmantenimiento);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mantenimiento = Mantenimiento::find($id);
        $relmantenimiento = Vs_Relmantenimiento::all();
        $areas = Area::all();
        $tecnicos = Tecnico::where('activo',1)->get();
        return view('mantenimiento.edit')->with('mantenimiento',$mantenimiento)->with('relmantenimiento', $relmantenimiento)->with('areas',$areas)->with('tecnicos',$tecnicos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $this->validate($request,[
            'tecnico_id'=>'required',
            'area_id'=>'required',
            'fecha_mantenimiento'=>'required'
        ]);
        $mantenimiento = Mantenimiento::find($id);
        $mantenimiento->id = $request->input('id');
        $mantenimiento->tecnico_id = $request->input('tecnico_id');
        $mantenimiento->area_id = $request->input('area_id');
        $mantenimiento->fecha_mantenimiento = $request->input('fecha_mantenimiento');
        $mantenimiento->update();
	//
    $log = new Log();
    $log->tabla = "mantenimientos";
    $mov="";
    $mov=$mov." id:".$mantenimiento->id ." tecnico_id:". $mantenimiento->tecnico_id ." area_id" .$mantenimiento->area_id;
    $mov=$mov." fecha_mantenimiento:".$mantenimiento->fecha_mantenimiento;
    $log->movimiento = $mov;
    $log->usuario_id = Auth::user()->id;
    $log->acciones = "Insercion";
    $log->save();
        //
        return redirect('mantenimiento')->with(array(
            'message'=>'El mantenimiento se guardó Correctamente'
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mantenimiento $mantenimiento)
    {
        //
    }

    public function busquedaEquiposMantenimiento(Request $request)
    {
        $validateData = $this->validate($request,[
            'busqueda'=>'required'
        ]);

        $busqueda = $request->input('busqueda');
        $id = $request->input('id');
        $mantenimiento = VsMantenimiento::find($id);
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
            $equipoPorPrestamo = EquipoPorPrestamo::where('id','=',$id)->get();
            return view('mantenimiento.agregarEquiposMantenimiento')->with('busqueda', $busqueda)->with('equipos',$equipos)
                ->with('mantenimiento', $mantenimiento )->with('id', $id)->with('equipoPorPrestamo', $equipoPorPrestamo);
        }else{
            return redirect('home')->with(array(
                'message'=>'Debe introducir un término de búsqueda'
            ));
        }
    }

 public function delete_mantenimiento($id){
    $mantenimiento = Mantenimiento::find($id);
    if($mantenimiento){
        $mantenimiento->activo = 0;
        $mantenimiento->update();
    //
    $log = new Log();
    $log->tabla = "mantenimientos";
    $mov="";
    $mov=$mov." id:".$mantenimiento->id ." tecnico_id:". $mantenimiento->tecnico_id ." area_id" .$mantenimiento->area_id;
    $mov=$mov." fecha_mantenimiento:".$mantenimiento->fecha_mantenimiento;
    $log->movimiento = $mov;
    $log->usuario_id = Auth::user()->id;
    $log->acciones = "Borrado";
    $log->save();
        //
        return redirect()->route('mantenimiento.index')->with(array(
           "message" => "El mantenimiento se ha eliminado correctamente"
        ));
    }else{
        return redirect()->route('home')->with(array(
           "message" => "El mantenimiento que trata de eliminar no existe"
        ));
    }

    

}

}

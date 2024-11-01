<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Solicitante;
use App\Models\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function index()
    {
        $solicitantes = Solicitante::all();
        $solicitantes = $this->cargarDT($solicitantes );
        return view('solicitantes.index_consulta')->with('solicitantes',$solicitantes);
    }
    public function cargarDT($consulta)
    {
        $solicitantes = [];

        foreach ($consulta as $key => $value){

            $ruta = "eliminar".$value['id'];
            $eliminar = route('delete-solicitante', $value['id']);
            $actualizar =  route('solicitantes.edit', $value['id']);
         

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
                      <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar  este solicitante?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p class="text-primary">
                        <small> 
                            '.$value['id'].', '.$value['nombre'].'                 </small>
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <a href="'.$eliminar.'" type="button" class="btn btn-danger">Eliminar</a>
                    </div>
                  </div>
                </div>
              </div>
            ';

            $solicitantes[$key] = array(
                $value['nombre'],
                $value['categoria'],
                $value['descripcion'],                
                $value['requisitos'],
                $value['procedimiento'],
                $value['contacto'],
                $value['tiempo_de_respuesta'], 
                $acciones,
            );

        }

        return $solicitantes;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::where('activo', 1)->get();
        return view('solicitantes.create') ->with('areas', $areas);
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
            'nombre'=>'required',
            'contacto_principal'=>'required',
        ]);

        $solicitante = new solicitante();
        $solicitante->nombre = $request->input('nombre');
        $solicitante->contacto_principal = $request->input('contacto_principal');
        $solicitante->contacto_secundario = $request->input('contacto_secundario');
        $solicitante->area_principal = $request->input('area_principal');
        

        $solicitante->save();
	//
        $log = new Log();
        $log->tabla = "solicitantes";
        $mov="";
        $mov=$mov." nombre:".$solicitante->nombre ." contacto_principal:". $solicitante->contacto_principal ." contacto_secundario:" .$solicitante->contacto_secundario;
        $mov=$mov." area_principal:".$solicitante->area_principal .".";
        $log->movimiento = $mov;
        $log->usuario_id = Auth::user()->id;
        $log->acciones = "Insercion";
        $log->save();
        //
        return redirect(route('tickets.create'));
    }

}

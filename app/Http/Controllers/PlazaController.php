<?php

namespace App\Http\Controllers;

use App\Models\Plaza;
use App\Models\Log;
use App\Models\VsEquipo;
use App\Models\VsTicket;
use App\Models\Curso;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



use Illuminate\Http\Request;

class PlazaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vsplazas = Plaza::where('activo', '=', 1)->get();
        $plazas = $this->cargarDT($vsplazas);
        return view('plazas.index')->with('plazas', $plazas);
    }
    public function cargarDT($consulta)
    {
        $plaza = [];

        foreach ($consulta as $key => $value) {
            $ruta = 'eliminar' . $value['id'];
            $eliminar = route('delete-plaza', $value['id']);
            $actualizar = route('plazas.edit', $value['id']);

            $acciones =
                '
                <div class="btn-acciones">
                    <div class="btn-circle">
                        <a href="' .
                $actualizar .
                '" role="button" class="btn btn-success" title="Actualizar">
                            <i class="far fa-edit"></i>
                        </a>
                        <a href="#' .
                $ruta .
                '" role="button" class="btn btn-danger" data-toggle="modal" title="Eliminar">
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
                      <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar este curso?</h5>
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
                $value['descripcion'] .
                '                 </small>
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <a href="' .
                $eliminar .
                '" type="button" class="btn btn-danger">Eliminar</a>
                    </div>
                  </div>
                </div>
              </div>
            ';

            $plaza[$key] = [
                
                $value['id'], 
                $value['nombre'], 
                $value['carga_horaria'],
                $acciones,
            ];
        }

        return $plaza;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plazas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $this->validate($request, [
            'nombre' => 'required',
            'carga_horaria' => 'required',
            'activo' => 'required',
        ]);

        $plaza = new Plaza();
        $plaza->nombre = $request->input('nombre');
        $plaza->carga_horaria = $request->input('carga_horaria');
        $plaza->activo = $request->input('activo');

        
        $plaza->save();
        
        $log = new Log();
        $log->tabla = 'plazas';
        $mov = '';
        $mov = $mov . 'nombre:' . $plaza->nombre . 'carga_horaria:' . $plaza->carga_horaria . 'activo' . $plaza->activo;
        $log->movimiento = $mov;
        $log->usuario_id = Auth::user()->id;
        $log->acciones = 'Insercion';
        $log->save();
        //
        return redirect('plazas')->with([
            'message' => 'La plaza se guardo Correctamente',
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
        $plaza = Plaza::find($id);
        return view('plazas.edit')->with('plaza', $plaza);
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
        $validateData = $this->validate($request, [
            'nombre' => 'required',
            'carga_horaria' => 'required',
            'activo' => 'required',
        ]);

        $plaza = Plaza::find($id);
        $plaza->nombre = $request->input('nombre');
        $plaza->carga_horaria = $request->input('carga_horaria');
        $plaza->activo = $request->input('activo');
       


        $plaza->update();
        //
        $log = new Log();
        $log->tabla = 'plazas';
        $mov = '';
        $mov = $mov . ' nombre' . $plaza->nombre . ' carga_horaria:' . $plaza->carga_horaria . ' activo' . $plaza->activo;
        $log->movimiento = $mov;
        $log->usuario_id = Auth::user()->id;
        $log->acciones = 'Edicion';
        $log->save();
        //
        return redirect('plazas')->with([
            'message' => 'La plaza se actualizo Correctamente',
        ]);
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
    public function delete_plaza($plaza_id)
    {
        $plaza = Plaza::find($plaza_id);
        if ($plaza) {
            $plaza->activo = 0;
            $plaza->update();
            //
            $log = new Log();
            $log->tabla = 'plazas';
            $mov = '';
            $mov = $mov . ' nombre:' . $plaza->nombre . 'carga_horaria:' . $plaza->carga_horaria . 'activo' . $plaza->activo;
            $log->movimiento = $mov;
            $log->usuario_id = Auth::user()->id;
            $log->acciones = 'Borrado';
            $log->save();
            //
            return redirect()
                ->route('plazas.index')
                ->with([
                    'message' => 'La plaza se ha eliminado correctamente',
                ]);
        } else {
            return redirect()
                ->route('home')
                ->with([
                    'message' => 'La plaza que trata de eliminar no existe',
                ]);
        }
        
    }
    public function getImage($filename)
    {
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }







}

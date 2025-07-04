<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Log;
use App\Models\VsEquipo;
use App\Models\VsTicket;
use App\Models\Curso;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vsareas = Area::where('activo', '=', 1)->get();
        $areas = $this->cargarDT($vsareas);
        return view('areas.index')->with('areas', $areas);
    }
    public function cargarDT($consulta)
    {
        $area = [];

        foreach ($consulta as $key => $value) {
            $ruta = 'eliminar' . $value['id'];
            $eliminar = route('delete-area', $value['id']);
            $actualizar = route('areas.edit', $value['id']);

            $acciones =
                '
                <div class="btn-acciones">
                    <div class="btn-circle">
                        <a href="' .
                $actualizar .
                '" role="button" class="btn btn-success btn-sm" title="Actualizar">
                            <i class="far fa-edit"></i>
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
                ', ' . $value['sede'] . ", " .
                $value['area'] .
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

            $area[$key] = [$value['id'], $value['tipo_espacio'], $value['sede'], $value['edificio'], $value['piso'], $value['division'], $value['coordinacion'], $value['area'], $acciones];
        }

        return $area;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('areas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'tipo_espacio' => 'required',
            'sede' => 'required',
            'edificio' => 'required',
            'piso' => 'required',
            'division' => 'required',
            'coordinacion' => 'required',
            'area' => 'required',
        ]);

        $area = new Area();
        $area->tipo_espacio = $request->input('tipo_espacio');
        $area->sede = $request->input('sede');
        $area->edificio = $request->input('edificio');
        $area->piso = $request->input('piso');
        $area->division = $request->input('division');
        $area->coordinacion = $request->input('coordinacion');
        if (isset($request->equipamiento)) {
            $equipamiento = implode(",", $request->input('equipamiento'));
            $area->equipamiento = $equipamiento;
        }

        $area->area = $request->input('area');

        $imagen_1 = $request->file('imagen_1');
        if ($imagen_1) {
            $image_path = time() . $imagen_1->getClientOriginalName();
            \Storage::disk('images')->put($image_path, \File::get($imagen_1));

            $area->imagen_1 = $image_path;
        }

        $imagen_2 = $request->file('imagen_2');
        if ($imagen_2) {
            $image_path = time() . $imagen_2->getClientOriginalName();
            \Storage::disk('images')->put($image_path, \File::get($imagen_2));

            $area->imagen_2 = $image_path;
        }

        $area->save();
        //
        $log = new Log();
        $log->tabla = 'areas';
        $mov = '';
        $mov = $mov . ' tipo_espacio:' . $area->tipo_espacio . ' sede:' . $area->sede . ' edificio' . $area->edificio;
        $mov = $mov . ' piso:' . $area->piso . ' division:' . $area->division . ' coordinacion' . $area->coordinacion;
        $mov = $mov . ' equipamiento:' . $area->equipamiento . ' area:' . $area->area . '.';
        $log->movimiento = $mov;
        $log->usuario_id = Auth::user()->id;
        $log->acciones = 'Insercion';
        $log->save();
        //
        return redirect('areas')->with([
            'message' => 'El área se guardo Correctamente',
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
        $equipamiento = [ 'Proyector' => '', 'PC' => '', 'TV' => '','Camara' => ''];
        $area = Area::find($id);
        $equipos_area = explode(",", $area->equipamiento);

        for ($i = 0; $i < count($equipos_area); $i++) {
            $temp = $equipos_area[$i];
            if (array_key_exists($temp, $equipamiento)) {
                $equipamiento[$temp] = "checked";
            }
        }
        //return $equipamiento;
        return view('areas.edit', compact('equipamiento'))->with('area', $area);
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
        $this->validate($request, [
            'tipo_espacio' => 'required',
            'sede' => 'required',
            'edificio' => 'required',
            'piso' => 'required',
            'division' => 'required',
            'coordinacion' => 'required',
            'area' => 'required',
        ]);

        $area = Area::find($id);
        $area->tipo_espacio = $request->input('tipo_espacio');
        $area->sede = $request->input('sede');
        $area->edificio = $request->input('edificio');
        $area->piso = $request->input('piso');
        $area->division = $request->input('division');
        $area->coordinacion = $request->input('coordinacion');
        if (isset($request->equipamiento)) {
            $equipamiento = implode(",", $request->input('equipamiento'));
            $area->equipamiento = $equipamiento;
        }

        $area->area = $request->input('area');

        $imagen_1 = $request->file('imagen_1');
        if ($imagen_1) {
            $image_path = time() . $imagen_1->getClientOriginalName();
            \Storage::disk('images')->put($image_path, \File::get($imagen_1));

            $area->imagen_1 = $image_path;
        }

        $imagen_2 = $request->file('imagen_2');
        if ($imagen_2) {
            $image_path = time() . $imagen_2->getClientOriginalName();
            \Storage::disk('images')->put($image_path, \File::get($imagen_2));

            $area->imagen_2 = $image_path;
        }


        $area->update();
        //
        $log = new Log();
        $log->tabla = 'areas';
        $mov = '';
        $mov = $mov . ' tipo_espacio:' . $area->tipo_espacio . ' sede:' . $area->sede . ' edificio' . $area->edificio;
        $mov = $mov . ' piso:' . $area->piso . ' division:' . $area->division . ' coordinacion' . $area->coordinacion;
        $mov = $mov . ' equipamiento:' . $area->equipamiento . ' area:' . $area->area . '.';
        $log->movimiento = $mov;
        $log->usuario_id = Auth::user()->id;
        $log->acciones = 'Edicion';
        $log->save();
        //
        return redirect('areas')->with([
            'message' => 'El área se actualizo Correctamente',
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

    public function delete_area($area_id)
    {
        $area = Area::find($area_id);
        if ($area) {
            $area->activo = 0;
            $area->update();
            //
            $log = new Log();
            $log->tabla = 'areas';
            $mov = '';
            $mov = $mov . ' tipo_espacio:' . $area->tipo_espacio . ' sede:' . $area->sede . ' edificio' . $area->edificio;
            $mov = $mov . ' piso:' . $area->piso . ' division:' . $area->division . ' coordinacion' . $area->coordinacion;
            $mov = $mov . ' equipamiento:' . $area->equipamiento . ' area:' . $area->area . '.';
            $log->movimiento = $mov;
            $log->usuario_id = Auth::user()->id;
            $log->acciones = 'Borrado';
            $log->save();
            //
            return redirect()
                ->route('areas.index')
                ->with([
                    'message' => 'El área se ha eliminado correctamente',
                ]);
        } else {
            return redirect()
                ->route('home')
                ->with([
                    'message' => 'El área que trata de eliminar no existe',
                ]);
        }
    }

    public function area_ticket($sede)
    {
        // Se obtienen las Aulas y Laboratorios
        $areas = Area::select('id', 'ultimo_inventario', 'tipo_espacio', 'equipamiento', 'edificio', 'piso', 'area', 'imagen_1', 'imagen_2')
            ->where('sede', '=', $sede)
            ->where('activo', 1)
            ->where('tipo_espacio', '!=', 'Administrativa')
            ->where('tipo_espacio', '!=', 'Administrativo')
            ->orderBy('edificio')
            ->get();

        // Se crea el contenedor principal
        $areas_f = [];
        date_default_timezone_set('America/Mexico_City');
        $hora = str_replace(':', '', date('H:i'));

        //dd($dia);
        $equipamiento = ['Pantalla Proyección' => 'crop_square', 'Proyector' => '', 'PC' => 'computer', 'Pantalla' => 'tv', 'Bocinas' => 'speaker', 'Camara' => 'videocam'];

        foreach ($areas as $item) {
            $item->equipamiento_icon = '';

            if (isset(explode(' ', $item->edificio)[1])) {
                $edificio = explode(' ', $item->edificio)[1];
            } else {
                $edificio = $item->edificio;
            }

            // Se obtienen los tickets abiertos para el aula
            $ticket = VsTicket::select('id', 'datos_reporte', 'area', 'area_id', 'solicitante', 'creado', 'prioridad')
                ->where('area_id', '=', $item->id)
                ->where('estatus', '1')
                ->get();

            if (strcmp('Planta Baja', $item->piso) == 0) {
                $item->piso = 'Piso 0';
            }
            // Verifica si tiene ticket's, si no los tiene guarda directamente el aula, en caso contrario recupera los tickets
            if (count($ticket) > 0) {
                $item->tickets = $ticket;
                if (array_key_exists($edificio, $areas_f)) {
                    if (array_key_exists($item->piso, $areas_f[$edificio])) {
                        array_push($areas_f[$edificio][$item->piso], $item->toArray());
                    } else {
                        $areas_f[$edificio][$item->piso] = [$item->toArray()];
                    }
                } else {
                    $areas_f[$edificio][$item->piso] = [$item->toArray()];
                }
            } else {
                if (isset($areas_f[$edificio])) {
                    if (array_key_exists($item->piso, $areas_f[$edificio])) {
                        array_push($areas_f[$edificio][$item->piso], $item->toArray());
                    } else {
                        $areas_f[$edificio][$item->piso] = [$item->toArray()];
                    }
                } else {
                    $areas_f[$edificio][$item->piso] = [$item->toArray()];
                }
            }
            ksort($areas_f[$edificio]);
        }
        $areas = collect($areas_f);
        return view('areas.area-ticket', compact('areas', 'sede'));
    }


    public function equipo_area($id)
    {
        $area = Area::select('ultimo_inventario', 'tipo_espacio', 'sede', 'edificio', 'piso', 'division', 'coordinacion', 'area')
            ->where('id', $id)
            ->first();

        $equipo = VsEquipo::where('activo', 1)->select('id', 'udg_id', 'resguardante', 'marca', 'modelo', 'numero_serie', 'tipo_equipo')->where('id_area', '=', $id)
            ->whereIn('tipo_equipo', ['CPU', 'Proyector', 'Monitor', 'Pantalla', 'No break', 'Bocinas', 'Soporte para Proyector', 'Botonera', 'Camara'])->orderBy('tipo_equipo')
            ->get();

        $grupos = VsEquipo::where('activo', 1)
            ->where('id_area', '=', $id)
            ->whereIn('tipo_equipo', ['CPU', 'Monitor','Proyector', 'Pantalla', 'No break', 'Bocinas', 'Soporte para Proyector', 'Botonera', 'Camara'])->get()->groupBy(function ($elmento) {
                return $elmento->tipo_equipo;
            });

        $cantidad = [];
        foreach ($grupos as $item => $llave) {
            $cantidad[$item] = count($llave);
        }

        $cantidad = collect($cantidad);
        return view('areas.equipos', compact('area', 'equipo', 'cantidad'));
    }

    public function buscar_edificio($sede, $edificio)
    {
        $edificio =  "Edificio " . $edificio;
        $areas = Area::select('id')->where('sede',$sede)->whereIn('tipo_espacio',['Aula','Laboratorio'])->where('edificio', $edificio)->get()->toArray();
        $equipos = VsEquipo::where('activo', 1)->whereIn('id_area',$areas)->get();
        $temp = $equipos->groupBy('tipo_equipo');
        $cantidad = [];
        foreach ($temp as $item => $llave) {
            $cantidad[$item] = count($llave);
        }
        return view('areas.equipos_edificio', compact('sede', 'edificio', 'equipos','cantidad'));
        
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Curso;
use App\Models\VsCurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($ciclo)
    {
        $areas = Area::whereIn('tipo_espacio', ['Aula', 'Laboratorio'])
                    ->where('activo','=',1)
                    ->get();

        $vscurso = VsCurso::where('activo','=',1)
                    ->where('ciclo', '=', $ciclo)                   
                    ->get();

        $cursos = $this->cargarDT($vscurso);
        
        return view('cursos.index')
                    ->with('cursos', $cursos)
                    ->with('areas', $areas);
    }

    public function cursos_presenciales($ciclo)
    {
        $areas = Area::whereIn('tipo_espacio', ['Aula', 'Laboratorio'])
                    ->where('activo','=',1)
                    ->get();

        $vscurso = VsCurso::where('activo','=',1)
                    ->where('ciclo', '=', $ciclo)
		    ->where('id_area', '<>', 628)  
                    ->get();

        $cursos = $this->cargarDT($vscurso);
        
        return view('cursos.index')
                    ->with('cursos', $cursos)
                    ->with('areas', $areas);
    }

    public function cursos_laboratorios($ciclo)
    {
        $areas = Area::whereIn('tipo_espacio', ['Laboratorio'])
                    ->where('activo','=',1)
                    ->get();

        $vscurso = VsCurso::where('activo','=',1)
		    ->where('ciclo', '=', $ciclo)                    
		    ->where('tipo_espacio', '=', 'Laboratorio')
		    ->where('sede', '=', 'Belenes')
		    ->where('id_area', '<>', 628)  
                    ->get();

        $cursos = $this->cargarDTLabs($vscurso);
        
        return view('cursos.laboratorios')
                    ->with('cursos', $cursos)
                    ->with('areas', $areas);
    }

    public function cargarDT($consulta)
    {
        $cursos = [];

        foreach ($consulta as $key => $value){

            $ruta = "eliminar".$value['id'];
            $eliminar = route('delete-curso', $value['id']);
            $actualizar =  route('cursos.edit', $value['id']);
         

            $acciones = '
                <div class="btn-acciones">
                    <div class="btn-circle">
                        <a href="'.$actualizar.'" class="btn btn-success" title="Actualizar">
                            <i class="fa fa-edit"></i>
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
                      <h5 class="modal-title" id="exampleModalLabel">Â¿Seguro que deseas eliminar este curso?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p class="text-primary">
                        <small> 
                            '.$value['curso'].', '.$value['ciclo'].', '.$value['dia'].', '.$value['aula'].', '.$value['departamento'].'
                        </small>
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

            $cursos[$key] = array(
                $acciones,
                $value['tipo'],
                $value["curso"],
                $value['departamento'],
                $value['lunes']." ".
		$value['martes']." ".
		$value['miercoles']." ".
		$value['jueves']." ".
		$value['viernes']." ".
		$value['sabado'],
                $value['horario'],
                $value['detalleAula'],
                $value['profesor'],
                $value['cupo'],
                $value['alumnos'],
                $value['crn'],
                $value['observaciones'],
                $value['id']
            );

        }

        return $cursos;
    }
public function cargarDTLabs($consulta)
    {
        $cursos = [];

        foreach ($consulta as $key => $value){

            $ruta = "eliminar".$value['id'];
            $eliminar = route('delete-curso', $value['id']);
            $actualizar =  route('cursos.edit', $value['id']);
         

            $acciones = '
                <div class="btn-acciones">
                    <div class="btn-circle">
                        <a href="'.$actualizar.'" role="button" class="btn btn-success" title="Actualizar">
                            <i class="fa fa-edit"></i>
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
                      <h5 class="modal-title" id="exampleModalLabel">Â¿Seguro que deseas eliminar este curso?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p class="text-primary">
                        <small> 
                            '.$value['curso'].', '.$value['ciclo'].', '.$value['dia'].', '.$value['aula'].', '.$value['departamento'].'
                        </small>
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

            $cursos[$key] = array(
                $acciones,
                $value["curso"],
                $value['departamento'],
                $value['lunes']." ".
		$value['martes']." ".
		$value['miercoles']." ".
		$value['jueves']." ".
		$value['viernes']." ".
		$value['sabado'],
                $value['horario'],
$value['sede'],
$value['edificio'],
$value['piso'],
                $value['detalleAula'],
                $value['profesor'],
                $value['crn'],
                $value['observaciones'],
                $value['id']
            );

        }

        return $cursos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cursos = Curso::all();
        
        $areas = Area::whereIn('tipo_espacio', ['Aula', 'Laboratorio'])
                    ->where('activo', '=', 1)
                    ->get();

        return view('cursos.create')
                    ->with('cursos', $cursos)
                    ->with('areas', $areas);
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
             'ciclo'=>'required',
             'tipo'=>'required',
             'dia'=>'required',
             'horario'=>'required',
             'crn'=>'required',
             'curso'=>'required',
             'codigo'=>'required',
             'profesor'=>'required',
             'cupo'=>'required',
             'alumnos'=>'required',
             'pe'=>'required',
             'departamento'=>'required',
             'observaciones'=>'required',
        ]);

        $aula = Area::where('id', '=', $request->input('id_area'))->get()->first();

        $curso = new Curso();
        $curso->id_area = $request->input('id_area');
        $curso->ciclo = $request->input('ciclo');
        $curso->tipo = $request->input('tipo');
        $curso->dia = $request->input('dia');
        $curso->aula = $aula->area;
        $curso->horario = $request->input('horario');
        $curso->crn = $request->input('crn');
        $curso->curso = $request->input('curso');
        $curso->codigo = $request->input('codigo');
        $curso->profesor  = $request->input('profesor');
        $curso->cupo = $request->input('cupo');
        $curso->alumnos = $request->input('alumnos');
        $curso->pe = $request->input('pe');
        $curso->departamento = $request->input('departamento');
        $curso->observaciones = $request->input('observaciones');
        $curso->save();
	//
        $log = new Log();
        $log->tablas = 'cursos';
        $log->movimimiento = "Área: ".$curso->id_area."Ciclo: ".$curso->ciclo."Tipo: ".$curso->tipo."Día: ".$curso->dia."Aula: ".$curso->aula."CRN: ". $curso->crn."Curso: ".$curso->curso."Código: ".$curso->codigo."Profesor: ".$curso->profesor."Cupo: ".$curso->cupo."Alumnos: ".$curso->alumno."PE: ".$curso->pe."Departamento: ".$curso->departamento."Observaciones: ".$curso->observaciones;
        $log->usuario_id = Auth::user()->id;
        $log->acciones = 'Insertar';
        $curso->save();
        //
        return redirect('cursos')->with(array(
            'message'=>'Curso aÃ±adido'
        ));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ciclo)
    {
        $areas = Area::whereIn('tipo_espacio', ['Aula', 'Laboratorio'])
                    ->where('activo','=',1)
                    ->get();

        $vscurso = VsCurso::where('activo','=',1)
                    ->where('ciclo', '=', $ciclo)
                    ->get();

        $cursos = $this->cargarDT($vscurso);
        
        return view('cursos.index')
                    ->with('cursos', $cursos)
                    ->with('areas', $areas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $curso = Curso::find($id);
        
        $areas = Area::whereIn('tipo_espacio', ['Aula', 'Laboratorio'])
                    ->where('activo', '=', 1)
                    ->get();
        
        return view('cursos.edit')
                    ->with('curso', $curso)
                    ->with('areas', $areas);
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
        $validateData = $this->validate($request,[
            'id_area'=>'required',
            'ciclo'=>'required',
            'tipo'=>'required',
            'dia'=>'required',
            'horario'=>'required',
            'crn'=>'required',
            'curso'=>'required',
            'codigo'=>'required',
            'profesor'=>'required',
            'cupo'=>'required',
            'alumnos'=>'required',
            'pe'=>'required',
            'departamento'=>'required',
            'observaciones'=>'required',
       ]);

       $aula = Area::where('id', '=', $request->input('id_area'))->get()->first();

       $curso = Curso::find($id);
       $curso->id_area = $request->input('id_area');
       $curso->ciclo = $request->input('ciclo');
       $curso->tipo = $request->input('tipo');
       $curso->dia = $request->input('dia');
       $curso->aula = $aula->area;
       $curso->horario = $request->input('horario');
       $curso->crn = $request->input('crn');
       $curso->curso = $request->input('curso');
       $curso->codigo = $request->input('codigo');
       $curso->profesor  = $request->input('profesor');
       $curso->cupo = $request->input('cupo');
       $curso->alumnos = $request->input('alumnos');
       $curso->pe = $request->input('pe');
       $curso->departamento = $request->input('departamento');
       $curso->observaciones = $request->input('observaciones');
       $curso->update();
       //
       $log = new Log();
       $log->tabla = "cursos";
       $mov="";
       $mov=$mov."Área: ".$curso->id_area."Ciclo: ".$curso->ciclo."Tipo: ".$curso->tipo."Día: ".$curso->dia."Aula: ".$curso->aula."CRN: ". $curso->crn."Curso: ".$curso->curso."Código: ".$curso->codigo."Profesor: ".$curso->profesor."Cupo: ".$curso->cupo."Alumnos: ".$curso->alumno."PE: ".$curso->pe."Departamento: ".$curso->departamento."Observaciones: ".$curso->observaciones;
       $log->movimiento = $mov;
       $log->usuario_id = Auth::user()->id;
       $log->acciones = "Edicion";
       $log->save();
       //
       return redirect()->back()->with(array(
           'message'=>'Curso actualizado'
       ));

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

    public function filtroCursos(Request $request){
        $areas = Area::where('activo','=',1)->get();
        $area = $request->input('id_area');
        //$estatus = $request->input('estatus');
        $areaElegida = Area::find($area);


        if((isset($area) && !is_null($area))){
            $filtro = Curso::where('id_area','=',$area)
                ->where('activo','=', 1)
                ->get();
            
            $cursos = $this->cargarDT($filtro);

        } else {
            $cursos = Curso::where('activo','=',1)->get();
        }

        return view('cursos.index')
                ->with('cursos',$cursos)
                ->with('areas', $areas)
                ->with('areaElegida',$areaElegida);

    }

    public function delete_curso($curso_id){
        
        $curso = Curso::find($curso_id);

        if($curso){

            $curso->activo = 0;
            $curso->update();
	     //
            $log = new Log();
        $log->tabla = "cursos";
        $mov="";
        $mov=$mov."Área: ".$curso->id_area."Ciclo: ".$curso->ciclo."Tipo: ".$curso->tipo."Día: ".$curso->dia."Aula: ".$curso->aula."CRN: ". $curso->crn."Curso: ".$curso->curso."Código: ".$curso->codigo."Profesor: ".$curso->profesor."Cupo: ".$curso->cupo."Alumnos: ".$curso->alumno."PE: ".$curso->pe."Departamento: ".$curso->departamento."Observaciones: ".$curso->observaciones.".";
        $log->movimiento = $mov;
        $log->usuario_id = Auth::user()->id;
        $log->acciones = "Borrrado";
        $log->save();
        //

            return redirect()->back()->with(array(
                "message" => "El curso se ha eliminado correctamente"
            ));

        }else{

            return redirect()->route('home')->with(array(
                "message" => "El curso que trata de eliminar no existe"
            ));
        }

    }

}
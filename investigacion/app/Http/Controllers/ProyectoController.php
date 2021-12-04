<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\VsProyecto;
use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProyectoController extends Controller
{

    public function index()
    {
        $evaluadores = User::where('role','=','evaluador')->get();
        $perfil = DB::table('users')->select('role')->where('id','=',Auth::user()->id)->get();
        $role = Arr::get($perfil, '0');
        //dd($role->role);
        if(Auth::user()->role == 'investigador'){
            $proyectos = VsProyecto::where('activo','=','1')->where('IdUsuario','=',Auth::user()->id)->get();
            $numero_proyectos = DB::table('vs_proyectos')->select(DB::raw('COUNT(*) as cuenta_proyectos'))->where('IdUsuario','=',Auth::user()->id)->first();
            return view('proyecto.index')->with('proyectos', $proyectos)->with('numero_proyectos', $numero_proyectos)->with('role',$role);
        }elseif(Auth::user()->role == 'evaluador'){
            $proyectos = VsProyecto::where('activo','=','1')->where('evaluador_id','=',Auth::user()->id)->get();
            return view('proyecto.index')->with('proyectos', $proyectos)->with('role',$role);
        }elseif(Auth::user()->role == 'admin'){
            $proyectos = VsProyecto::where('activo','=','1')->get();
            return view('proyecto.index')->with('proyectos', $proyectos)->with('evaluadores', $evaluadores)->with('role',$role);
        }elseif (Auth::user()->role == 'investigador-evaluador'){
            $role->role = 'investigador';
            $proyectos = VsProyecto::where('activo','=','1')->where('IdUsuario','=',Auth::user()->id)->get();
            $numero_proyectos = DB::table('vs_proyectos')->select(DB::raw('COUNT(*) as cuenta_proyectos'))->where('IdUsuario','=',Auth::user()->id)->first();
            return view('proyecto.index')->with('proyectos', $proyectos)->with('numero_proyectos', $numero_proyectos)->with('role',$role);
        }else{
            return view('home');
        }
    }

    public function create()
    {
        return view('proyecto.crearProyecto');
    }

    public function store(Request $request)
    {
        $validateData = $this->validate($request,[
            'anio'=>'required',
            'nombre_responsable'=>'required',
            'correo_responsable'=>'required',
            'nombramiento'=>'required',
            'reconocimiento_sni'=>'required',
            'reconocimiento_promep'=>'required',
            'reconocimiento_proesde'=>'required',
            'departamento'=>'required',
            'division'=>'required',
            'registro_otras_instituciones'=>'required',
            'tipo_registro'=>'required',
            'titulo_proyecto'=>'required',
            'abstract'=>'required',
            'fecha_inicio'=>'required',
            'fecha_fin'=>'required',
            'tipo_proyecto'=>'required',
            'tiempo_proyecto'=>'required',
            'objetivos'=>'required',
            'preguntas'=>'required',
            'metodologia'=>'required'
        ]);
        $proyecto = new Proyecto();
        $proyecto->anio = $request->input('anio');
        $proyecto->IdUsuario = $request->input('IdUser');
        $proyecto->evaluador_id = 268;
        $proyecto->nombre_responsable = $request->input('nombre_responsable');
        $proyecto->correo_responsable = $request->input('correo_responsable');
        $proyecto->nombramiento = $request->input('nombramiento');
        $proyecto->reconocimiento_sni = $request->input('reconocimiento_sni');
        $proyecto->reconocimiento_promep = $request->input('reconocimiento_promep');
        $proyecto->reconocimiento_proesde = $request->input('reconocimiento_proesde');
        $proyecto->cuerpo_academico = $request->input('cuerpo_academico');
        $proyecto->departamento = $request->input('departamento');
        $proyecto->division = $request->input('division');
        $proyecto->registro_otras_instituciones = $request->input('registro_otras_instituciones');
        $proyecto->financiamiento = $request->input('financiamiento');
        $proyecto->tipo_registro = $request->input('tipo_registro');
        $proyecto->monto_pasaje_aereo_nacional = $request->input('monto_pasaje_aereo_nacional');
        $proyecto->monto_pasaje_terrestre_nacional = $request->input('monto_pasaje_terrestre_nacional');
        $proyecto->monto_combustible_vehiculo = $request->input('monto_combustible_vehiculo');
        $proyecto->monto_viaticos = $request->input('monto_viaticos');
        $proyecto->monto_materiales = $request->input('monto_materiales');
        $proyecto->monto_equipos_menores_oficina = $request->input('monto_equipos_menores_oficina');
        $proyecto->monto_total = $request->input('monto_total');
        $proyecto->justificacion = $request->input('justificacion');
        $proyecto->personal_adscrito = $request->input('personal_adscrito');
        $proyecto->estudiantes_adscritos = $request->input('estudiantes_adscritos');
        $proyecto->colaboradores_externos = $request->input('colaboradores_externos');
        $proyecto->titulo_proyecto = $request->input('titulo_proyecto');
        $proyecto->abstract = $request->input('abstract');
        $proyecto->fecha_inicio = $request->input('fecha_inicio');
        $proyecto->fecha_fin = $request->input('fecha_fin');
        $proyecto->tipo_proyecto = $request->input('tipo_proyecto');
        $proyecto->tiempo_proyecto = $request->input('tiempo_proyecto');
        $proyecto->objetivos = $request->input('objetivos');
        $proyecto->preguntas = $request->input('preguntas');
        $proyecto->hipotesis = $request->input('hipotesis');
        $proyecto->metodologia = $request->input('metodologia');
        $proyecto->generacion_conocimiento = $request->input('generacion_conocimiento');
        $proyecto->actividades_divulgacion = $request->input('actividades_divulgacion');
        $proyecto->actividades_vinculacion = $request->input('actividades_vinculacion');
        $proyecto->vinculacion_otros_investigadores = $request->input('vinculacion_otros_investigadores');
        $proyecto->vinculacion_grupos_investigacion = $request->input('vinculacion_grupos_investigacion');
        $proyecto->vinculacion_sectores = $request->input('vinculacion_sectores');
        //Subida del archivo proyecto en extenso
        $extenso = $request->file('proyecto_extenso');
        if($extenso){
            $extenso_path = time().$extenso->getClientOriginalName();
            \Storage::disk('documentos')->put($extenso_path, \File::get($extenso));
            $proyecto->proyecto_extenso = $extenso_path;
        }
	    $proyecto->definitivo = 'No';
        $proyecto->evaluado = 'No';
        //Subida del archivo acta colegio departamental
       /* $acta = $request->file('acta_colegio');
        if($acta){
            $acta_path = time().$acta->getClientOriginalName();
            \Storage::disk('documentos')->put($acta_path, \File::get($acta));
            $proyecto->acta_colegio = $acta_path;
        }*/
        $proyecto->save();

        return redirect('proyectos')->with(array(
            'message'=>'El Proyecto se subio Correctamente'
        ));
    }

    public function show($id)
    {
        $proyecto = VsProyecto::find($id);
        return view('proyecto.detalleProyecto')->with('proyecto', $proyecto);
    }

    public function edit($id)
    {
        $proyecto = Proyecto::find($id);
        return view('proyecto.edit')->with('proyecto', $proyecto);
    }


    public function update(Request $request, $id)
    {
        $validateData = $this->validate($request,[
            'anio'=>'required',
            'nombre_responsable'=>'required',
            'correo_responsable'=>'required',
            'nombramiento'=>'required',
            'reconocimiento_sni'=>'required',
            'reconocimiento_promep'=>'required',
            'reconocimiento_proesde'=>'required',
            'departamento'=>'required',
            'division'=>'required',
            'registro_otras_instituciones'=>'required',
            'tipo_registro'=>'required',
            'titulo_proyecto'=>'required',
            'abstract'=>'required',
            'fecha_inicio'=>'required',
            'fecha_fin'=>'required',
            'tipo_proyecto'=>'required',
            'tiempo_proyecto'=>'required',
            'objetivos'=>'required',
            'preguntas'=>'required',
            'metodologia'=>'required'
        ]);
        $proyecto = Proyecto::find($id);
        $proyecto->anio = $request->input('anio');
        $proyecto->IdUsuario = $request->input('IdUser');
        $proyecto->evaluador_id = 268;
        $proyecto->nombre_responsable = $request->input('nombre_responsable');
        $proyecto->correo_responsable = $request->input('correo_responsable');
        $proyecto->nombramiento = $request->input('nombramiento');
        $proyecto->reconocimiento_sni = $request->input('reconocimiento_sni');
        $proyecto->reconocimiento_promep = $request->input('reconocimiento_promep');
        $proyecto->reconocimiento_proesde = $request->input('reconocimiento_proesde');
        $proyecto->cuerpo_academico = $request->input('cuerpo_academico');
        $proyecto->departamento = $request->input('departamento');
        $proyecto->division = $request->input('division');
        $proyecto->registro_otras_instituciones = $request->input('registro_otras_instituciones');
        $proyecto->financiamiento = $request->input('financiamiento');
        $proyecto->tipo_registro = $request->input('tipo_registro');
        $proyecto->monto_pasaje_aereo_nacional = $request->input('monto_pasaje_aereo_nacional');
        $proyecto->monto_pasaje_terrestre_nacional = $request->input('monto_pasaje_terrestre_nacional');
        $proyecto->monto_combustible_vehiculo = $request->input('monto_combustible_vehiculo');
        $proyecto->monto_viaticos = $request->input('monto_viaticos');
        $proyecto->monto_materiales = $request->input('monto_materiales');
        $proyecto->monto_equipos_menores_oficina = $request->input('monto_equipos_menores_oficina');
        $proyecto->monto_total = $request->input('monto_total');
        $proyecto->justificacion = $request->input('justificacion');
        $proyecto->personal_adscrito = $request->input('personal_adscrito');
        $proyecto->estudiantes_adscritos = $request->input('estudiantes_adscritos');
        $proyecto->colaboradores_externos = $request->input('colaboradores_externos');
        $proyecto->titulo_proyecto = $request->input('titulo_proyecto');
        $proyecto->abstract = $request->input('abstract');
        $proyecto->fecha_inicio = $request->input('fecha_inicio');
        $proyecto->fecha_fin = $request->input('fecha_fin');
        $proyecto->tipo_proyecto = $request->input('tipo_proyecto');
        $proyecto->tiempo_proyecto = $request->input('tiempo_proyecto');
        $proyecto->objetivos = $request->input('objetivos');
        $proyecto->preguntas = $request->input('preguntas');
        $proyecto->hipotesis = $request->input('hipotesis');
        $proyecto->metodologia = $request->input('metodologia');
        $proyecto->generacion_conocimiento = $request->input('generacion_conocimiento');
        $proyecto->actividades_divulgacion = $request->input('actividades_divulgacion');
        $proyecto->actividades_vinculacion = $request->input('actividades_vinculacion');
        $proyecto->vinculacion_otros_investigadores = $request->input('vinculacion_otros_investigadores');
        $proyecto->vinculacion_grupos_investigacion = $request->input('vinculacion_grupos_investigacion');
        $proyecto->vinculacion_sectores = $request->input('vinculacion_sectores');
        //Subida del archivo proyecto en extenso
        $extenso = $request->file('proyecto_extenso');
        if($extenso){
            $extenso_path = time().$extenso->getClientOriginalName();
            \Storage::disk('documentos')->put($extenso_path, \File::get($extenso));
            $proyecto->proyecto_extenso = $extenso_path;
        }




        $proyecto->update();

        return redirect('proyectos')->with(array(
            'message'=>'El Proyecto se actualizado correctamente'
        ));
    }

    public function destroy($id)
    {
        //
    }

    public function getDocumento($filename){
        $file = Storage::disk('documentos')->get($filename);
        return new Response($file, 200);
    }
    public function getDocumentoTestado($filename){
        $file = Storage::disk('documentos_testados')->get($filename);
        return new Response($file, 200);
    }

    public function rolar_definitivo($proyecto_id){
        $proyecto = Proyecto::find($proyecto_id);
        if ($proyecto) {
            $proyecto->definitivo = 'Si';
            $proyecto->update();
            return redirect()->route('proyectos.index')->with(array(
                "message" => "El proyecto se ha enviado como definitivo"
            ));
        } else {
            return redirect()->route('home')->with(array(
                "message" => "El proyecto que trata de mandar como definitivo no existe"
            ));
        }
    }
    public function asignar_evaluador(Request $request){
        $proyecto_id = $request->input('proyecto_id');

        $proyecto = Proyecto::find($proyecto_id);
        $proyecto->evaluador_id = $request->input('evaluador_id');
        $proyecto->update();

        return redirect()->route('proyectos.index')->with(array(
            "message" => "Se ha asignado el evaluador correctamente. Folio: ".$proyecto_id
        ));
    }

    public function evaluacionDefinitiva($proyecto_id){
        //Buscar el _proyecto_id en la tabla proyectos
        $proyecto = Proyecto::find($proyecto_id);
        //Actualizar el campo "evaluado" a "Si"
        $proyecto->evaluado = 'Si';
        $proyecto->save();

        return redirect()->route('proyectos.index')->with(array(
            "message" => "Evaluación del proyecto terminada correctamente"
        ));
    }

    public function index_general()
    {
        $evaluadores = User::where('role','=','evaluador')->get();

        if(Auth::user()->role == 'investigador'){
            $proyectos = VsProyecto::where('activo','=','1')->where('IdUsuario','=',Auth::user()->id)->get();
            $numero_proyectos = DB::table('vs_proyectos')->select(DB::raw('COUNT(*) as cuenta_proyectos'))->where('IdUsuario','=',Auth::user()->id)->first();
            return view('proyecto.indexGeneral')->with('proyectos', $proyectos)->with('numero_proyectos', $numero_proyectos);
        }elseif(Auth::user()->role == 'evaluador'){
            $proyectos = VsProyecto::where('activo','=','1')->where('evaluador_id','=',Auth::user()->id)->get();
            return view('proyecto.indexGeneral')->with('proyectos', $proyectos);
        }elseif(Auth::user()->role == 'admin'){
            $proyectos = VsProyecto::where('activo','=','1')->get();
            return view('proyecto.indexGeneral')->with('proyectos', $proyectos)->with('evaluadores', $evaluadores);
        }else{
            return view('home');
        }
    }

    public function proyectos_evaluador()
    {
        $numero_proyectos = DB::table('vs_proyectos')->select(DB::raw('COUNT(*) as cuenta_proyectos'))->where('IdUsuario','=',Auth::user()->id)->first();
        $perfil = DB::table('users')->select('role')->where('id','=',Auth::user()->id)->get();
        $role = Arr::get($perfil, '0');
        $role->role = 'evaluador';

        $proyectos = VsProyecto::where('activo','=','1')->where('evaluador_id','=',Auth::user()->id)->get();
        return view('proyecto.index')->with('proyectos', $proyectos)->with('numero_proyectos', $numero_proyectos)->with('role',$role);
    }
}

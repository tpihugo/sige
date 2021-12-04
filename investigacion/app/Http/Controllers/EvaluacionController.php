<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class EvaluacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validateData = $this->validate($request,[
            'propuesta_calificacion'=>'required',
            'propuesta_motivos_calificacion'=>'required'
        ]);
        $evaluacion = new Evaluacion();
        $evaluacion->IdProyecto = $request->input('IdProyecto');
        $evaluacion->propuesta_calificacion = $request->input('propuesta_calificacion');
        $evaluacion->propuesta_motivos_calificacion = $request->input('propuesta_motivos_calificacion');
        $evaluacion->conocimiento_calificacion = $request->input('conocimiento_calificacion');
        $evaluacion->conocimiento_motivos_calificacion = $request->input('conocimiento_motivos_calificacion');
        $evaluacion->problema_calificacion = $request->input('problema_calificacion');
        $evaluacion->problema_motivos_calificacion = $request->input('problema_motivos_calificacion');
        $evaluacion->planteamiento_calificacion = $request->input('planteamiento_calificacion');
        $evaluacion->planteamiento_motivos_calificacion = $request->input('planteamiento_motivos_calificacion');
        $evaluacion->metodologia_calificacion = $request->input('metodologia_calificacion');
        $evaluacion->metodologia_motivos_calificacion = $request->input('metodologia_motivos_calificacion');
        $evaluacion->resultados_calificacion = $request->input('resultados_calificacion');
        $evaluacion->resultados_motivos_calificacion = $request->input('resultados_motivos_calificacion');
        //$evaluacion->colaboracion_calificacion = $request->input('colaboracion_calificacion');
        //$evaluacion->colaboracion_alumnos_calificacion = $request->input('colaboracion_alumnos_calificacion');
        $evaluacion->evaluacion = $request->input('evaluacion');
        $evaluacion->observaciones = $request->input('observaciones');
        $evaluacion->fecha_evaluacion = $request->input('fecha_evaluacion');
        $evaluacion->nombre_evaluador = $request->input('nombre_evaluador');
        $evaluacion->codigo_evaluador = $request->input('codigo_evaluador');
        $evaluacion->save();
        return redirect('proyectos')->with(array(
            'message'=>'La Evaluación se guardo Correctamente'
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
        $evaluacion = Evaluacion::find($id);
        return view('evaluacion.edit')->with('evaluacion', $evaluacion);

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
            'propuesta_calificacion'=>'required',
            'propuesta_motivos_calificacion'=>'required'
        ]);
        $evaluacion = Evaluacion::find($id);
        $evaluacion->IdProyecto = $request->input('IdProyecto');
        $evaluacion->propuesta_calificacion = $request->input('propuesta_calificacion');
        $evaluacion->propuesta_motivos_calificacion = $request->input('propuesta_motivos_calificacion');
        $evaluacion->conocimiento_calificacion = $request->input('conocimiento_calificacion');
        $evaluacion->conocimiento_motivos_calificacion = $request->input('conocimiento_motivos_calificacion');
        $evaluacion->problema_calificacion = $request->input('problema_calificacion');
        $evaluacion->problema_motivos_calificacion = $request->input('problema_motivos_calificacion');
        $evaluacion->planteamiento_calificacion = $request->input('planteamiento_calificacion');
        $evaluacion->planteamiento_motivos_calificacion = $request->input('planteamiento_motivos_calificacion');
        $evaluacion->metodologia_calificacion = $request->input('metodologia_calificacion');
        $evaluacion->metodologia_motivos_calificacion = $request->input('metodologia_motivos_calificacion');
        $evaluacion->resultados_calificacion = $request->input('resultados_calificacion');
        $evaluacion->resultados_motivos_calificacion = $request->input('resultados_motivos_calificacion');
        //$evaluacion->colaboracion_calificacion = $request->input('colaboracion_calificacion');
        //$evaluacion->colaboracion_alumnos_calificacion = $request->input('colaboracion_alumnos_calificacion');
        $evaluacion->evaluacion = $request->input('evaluacion');
        $evaluacion->observaciones = $request->input('observaciones');
        $evaluacion->fecha_evaluacion = $request->input('fecha_evaluacion');
        $evaluacion->nombre_evaluador = $request->input('nombre_evaluador');
        $evaluacion->codigo_evaluador = $request->input('codigo_evaluador');
        $evaluacion->save();
        return redirect('proyectos')->with(array(
            'message'=>'La evaluación se actualizó correctamente'
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

    //Funcion de crear evaluacion
    public function create_evaluacion($proyecto_id){
        return view('evaluacion.create')->with('proyecto_id', $proyecto_id);
    }
}

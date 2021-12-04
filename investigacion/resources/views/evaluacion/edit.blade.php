@extends('layouts.app')
@section('content')
    <div class="container">
        @if(Auth::check())
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>

                </div>
            @endif
                <div class="row">
                    <div class="col-md-12">
                        <h3><br>FORMATO DE EVALUACIÓN.
                            CONVOCATORIA PARA PROYECTOS DE INVESTIGACIÓN 2021
                        </h3>
                        <h4>Número de Folio del Proyecto: {{$evaluacion->IdProyecto}}</h4><br>
                        <h5>La exposición de motivos hasta 400 caracteres IMPORTANTE!!! USAR CHROME (GOOGLE) O FIREFOX PARA LLENAR ESTE FORMATO.</h5>
                    </div>
                    <hr>
                </div>
            <form action="{{route('evaluaciones.update',$evaluacion->id)}}" method="post" enctype="multipart/form-data" class="col-12">
                @method('PUT')
                <div class="row">
                    <div class="col">
                        {!! csrf_field() !!}
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    Debe de llenar los campos marcados con un asterisco (*) o el formulario y su información ya se registró.
                                </ul>
                            </div>
                        @endif
                        <br>
                        {{-- Pregunta 1 --}}
                        <div class="row g-3 align-items-baseline" >
                            <div class="col-md-12">
                                <label for="propuesta_calificacion"><h5>1.- La propuesta de investigación ¿presenta el estudio un problema novedoso y relevante?</h5></label>
                                <input type="hidden" class="form-control" id="IdProyecto" name="IdProyecto" value="{{$evaluacion->IdProyecto}}" readonly>
                            </div>
                        </div>
                        <div class="row g-3 align-items-baseline">
                            <div class="col-md-4">
                                <label for="propuesta_calificacion">Seleccione</label>
                                <select class="form-control" id="propuesta_calificacion" name="propuesta_calificacion">
                                    <option value="{{$evaluacion->propuesta_calificacion}}" selected>{{$evaluacion->propuesta_calificacion}}</option>
                                    <option disabled >Seleccionar</option>
                                    <option value="Cumple">Cumple</option>
                                    <option value="No cumple">No cumple</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label for="propuesta_motivos_calificacion">Argumente </label>
                                <textarea class="form-control" id="propuesta_motivos_calificacion" name="propuesta_motivos_calificacion">{{$evaluacion->propuesta_motivos_calificacion}}</textarea>
                            </div>
                        </div>
                        {{-- Fin de la Pregunta 1 --}}
                        <br>
                        {{-- Pregunta 2 --}}
                        <div class="row g-3 align-items-baseline">
                            <div class="col-md-12">
                                <label for="propuesta_calificacion"><h5>2  ¿Se denota un conocimiento amplio sobre los  antecedentes de la problemática planteada?</h5></label>
                            </div>
                        </div>
                        <div class="row g-3 align-items-baseline">
                            <div class="col-md-4">
                                <label for="conocimiento_calificacion">Seleccione</label>
                                <select class="form-control" id="conocimiento_calificacion" name="conocimiento_calificacion">
                                    <option value="{{$evaluacion->conocimiento_calificacion}}" selected>{{$evaluacion->conocimiento_calificacion}}</option>
                                    <option disabled >Seleccionar</option>
                                    <option value="Cumple">Cumple</option>
                                    <option value="No cumple">No cumple</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label for="conocimiento_motivos_calificacion">Argumente  </label>
                                <textarea class="form-control" id="conocimiento_motivos_calificacion" name="conocimiento_motivos_calificacion">{{$evaluacion->conocimiento_motivos_calificacion}}</textarea>
                            </div>
                        </div>
                        {{-- Fin de la Pregunta 2 --}}
                        <br>
                        {{-- Pregunta 3 --}}
                        <div class="row g-3 align-items-baseline">
                            <div class="col-md-12">
                                <label for="problema_calificacion"><h5>3.- ¿Se expone con claridad el problema de estudio, de tal manera que los objetivos, pregunta e hipótesis se abordan de forma clara?</h5></label>
                            </div>
                        </div>
                        <div class="row g-3 align-items-baseline">
                            <div class="col-md-4">
                                <label for="problema_calificacion">Seleccione</label>
                                <select class="form-control" id="problema_calificacion" name="problema_calificacion">
                                    <option value="{{$evaluacion->problema_calificacion}}" selected>{{$evaluacion->problema_calificacion}}</option>
                                    <option disabled >Seleccionar</option>
                                    <option value="Cumple">Cumple</option>
                                    <option value="No cumple">No cumple</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label for="problema_motivos_calificacion">Argumente </label>
                                <textarea class="form-control" id="problema_motivos_calificacion" name="problema_motivos_calificacion">{{$evaluacion->problema_motivos_calificacion}}</textarea>
                            </div>
                        </div>
                        {{-- Fin de la Pregunta 3 --}}
                        <br>
                        {{-- Pregunta 4 --}}
                        <div class="row g-3 align-items-baseline">
                            <div class="col-md-12">
                                <label for="planteamiento_calificacion"><h5>4.- ¿Existe un planteamiento teórico consistente?</h5></label>
                            </div>
                        </div>
                        <div class="row g-3 align-items-baseline">
                            <div class="col-md-4">
                                <label for="planteamiento_calificacion">Seleccione</label>
                                <select class="form-control" id="planteamiento_calificacion" name="planteamiento_calificacion">
                                    <option value="{{$evaluacion->planteamiento_calificacion}}" selected>{{$evaluacion->planteamiento_calificacion}}</option>
                                    <option disabled >Seleccionar</option>
                                    <option value="Cumple">Cumple</option>
                                    <option value="No cumple">No cumple</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label for="planteamiento_motivos_calificacion">Argumente </label>
                                <textarea class="form-control" id="planteamiento_motivos_calificacion" name="planteamiento_motivos_calificacion">{{$evaluacion->planteamiento_motivos_calificacion}}</textarea>
                            </div>
                        </div>
                        {{-- Fin de la Pregunta 4 --}}
                        <br>
                        {{-- Pregunta 5 --}}
                        <div class="row g-3 align-items-baseline">
                            <div class="col-md-12">
                                <label for="metodologia_calificacion"><h5>5.- ¿Es clara la exposición de la  metodología?</h5></label>
                            </div>
                        </div>
                        <div class="row g-3 align-items-baseline">
                            <div class="col-md-4">
                                <label for="metodologia_calificacion">Seleccione</label>
                                <select class="form-control" id="metodologia_calificacion" name="metodologia_calificacion">
                                    <option value="{{$evaluacion->metodologia_calificacion}}" selected>{{$evaluacion->metodologia_calificacion}}</option>
                                    <option disabled >Seleccionar</option>
                                    <option value="Cumple">Cumple</option>
                                    <option value="No cumple">No cumple</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label for="metodologia_motivos_calificacion">Argumente </label>
                                <textarea class="form-control" id="metodologia_motivos_calificacion" name="metodologia_motivos_calificacion">{{$evaluacion->metodologia_motivos_calificacion}}</textarea>
                            </div>
                        </div>
                        {{-- Fin de la Pregunta 5 --}}
                        <br>
                        {{-- Pregunta 6 --}}
                        <div class="row g-3 align-items-baseline">
                            <div class="col-md-12">
                                <label for="resultados_calificacion"><h5>6.-¿En el proyecto se presentan aportes en su campo de conocimiento?</h5></label>
                            </div>
                        </div>
                        <div class="row g-3 align-items-baseline">
                            <div class="col-md-4">
                                <label for="resultados_calificacion">Seleccione</label>
                                <select class="form-control" id="resultados_calificacion" name="resultados_calificacion">
                                    <option value="{{$evaluacion->resultados_calificacion}}" selected>{{$evaluacion->resultados_calificacion}}</option>
                                    <option disabled >Seleccionar</option>
                                    <option value="Cumple">Cumple</option>
                                    <option value="No cumple">No cumple</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label for="resultados_motivos_calificacion">Argumente  </label>
                                <textarea class="form-control" id="resultados_motivos_calificacion" name="resultados_motivos_calificacion">{{$evaluacion->resultados_motivos_calificacion}}</textarea>
                            </div>
                        </div>
                        {{-- Fin de la Pregunta 6 --}}

                        {{-- Pregunta 7
                        <div class="row g-3 align-items-baseline">
                            <div class="col-md-12">
                                <label for="colaboracion_calificacion"><h5>7.- ¿ El/ La  responsable de proyecto incluye colaboración de profesores?.</h5></label>
                            </div>
                        </div>
                        <div class="row g-3 align-items-baseline">
                            <div class="col-md-12">
                                <select class="form-control" id="colaboracion_calificacion" name="colaboracion_calificacion">
                                    <option selected value="{{$evaluacion->colaboracion_calificacion}}">{{$evaluacion->colaboracion_calificacion}}</option>
                                    <option disabled >Elegir</option>
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                         Fin de la Pregunta 7 --}}

                        {{-- Pregunta 8
                        <div class="row g-3 align-items-baseline">
                            <div class="col-md-12">
                                <label for="colaboracion_alumnos_calificacion"><h5>8.-¿ El/ La  responsable de proyecto incluye colaboración de alumnos?</h5></label>
                            </div>
                        </div>
                        <div class="row g-3 align-items-baseline">
                            <div class="col-md-12">
                                <select class="form-control" id="colaboracion_alumnos_calificacion" name="colaboracion_alumnos_calificacion">
                                    <option selected value="{{$evaluacion->colaboracion_alumnos_calificacion}}">{{$evaluacion->colaboracion_alumnos_calificacion}}</option>
                                    <option disabled >Elegir</option>
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        Fin de la Pregunta 8 --}}

                        {{-- Pregunta 9 --}}
                        <div class="row g-3 align-items-baseline">
                            <div class="col-md-12">
                                <label for="evaluacion"><h5>Evaluación</h5></label>
                            </div>
                        </div>
                        <div class="row g-3 align-items-baseline">
                            <div class="col-md-12">
                                <select class="form-control" id="evaluacion" name="evaluacion">
                                    <option selected value="{{$evaluacion->evaluacion}}">{{$evaluacion->evaluacion}}</option>
                                    <option disabled>Elegir</option>
                                    <option value="Aceptado">Aceptado</option>
                                    <option value="No aceptado">No aceptado</option>
                                </select>
                            </div>
                        </div>
                        {{-- Fin de la Pregunta 9 --}}
                        <br>
                        {{-- Pregunta 10 --}}
                        <div class="row g-3 align-items-baseline">
                            <div class="col-md-12">
                                <label for="observaciones"><h5>Observaciones y Sugerencias (pueden ser en cada uno de los puntos a evaluar o solamente al final o ambas opciones)</h5></label>
                            </div>
                        </div>
                        <div class="row g-3 align-items-baseline">
                            <div class="col-md-12">
                                <div class="col-md-8">
                                    <textarea class="form-control" id="observaciones" name="observaciones">{{$evaluacion->observaciones}}</textarea>
                                </div>
                            </div>
                        </div>
                        {{-- Fin de la Pregunta 10 --}}
                        <br>
                        {{-- Pregunta 11 --}}
                        <div class="row g-3 align-items-baseline">
                            <div class="col-md-12">
                                <label for="fecha_evaluacion"><h5>Fecha de evaluación</h5></label>
                            </div>
                        </div>
                        <div class="row g-3 align-items-baseline">
                            <div class="col-md-12">
                                <div class="col-md-8">
                                    <input type="date" class="form-control" id="fecha_evaluacion" name="fecha_evaluacion" value="{{$evaluacion->fecha_evaluacion}}">
                                </div>
                            </div>
                        </div>
                        {{-- Fin de la Pregunta 11 --}}
                        <br>
                        {{-- Pregunta 12 --}}
                        <div class="row g-3 align-items-baseline">
                            <div class="col-md-12">
                                <label for="nombre_evaluador"><h5>Nombre evaluador(a)</h5></label>
                            </div>
                        </div>
                        <div class="row g-3 align-items-baseline">
                            <div class="col-md-12">
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="nombre_evaluador" name="nombre_evaluador" value="{{$evaluacion->nombre_evaluador}}">
                                </div>
                            </div>
                        </div>
                        {{-- Fin de la Pregunta 12 --}}
                        <br>
                        {{-- Pregunta 13 --}}
                        <div class="row g-3 align-items-baseline">
                            <div class="col-md-12">
                                <label for="codigo_evaluador"><h5>Código evaluador(a)</h5></label>
                            </div>
                        </div>
                        <div class="row g-3 align-items-baseline">
                            <div class="col-md-12">
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="codigo_evaluador" name="codigo_evaluador" value="{{$evaluacion->codigo_evaluador}}">
                                </div>
                            </div>
                        </div>
                        {{-- Fin de la Pregunta 13 --}}

                        <br>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <a href="{{ route('proyectos.index') }}" class="btn btn-danger">Cancelar</a>
                                <button type="submit" class="btn btn-success">Guardar Información</button>
                            </div>
                        </div>
                    </div>
                </div>
                <br>

            </form>

            <div class="row g-3 align-items-center">
                <br>
                <h5>En caso de tener alguna duda, contactar a la Coordinación de Investigación  con el correo electrónico: ofelia.woo@academicos.udg.mx</h5>
                <hr>
                <p>Secretaría Académica / Coordinación de investigación y Posgrado</p>
                <p>CUCSH</p>
            </div>
    </div>

    @else
        El periodo de Registro de Proyectos a terminado
    @endif

@endsection

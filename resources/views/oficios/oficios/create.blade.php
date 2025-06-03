@extends('adminlte::page')
@section('title', 'Crear Oficio Liberación')

@section('css')
    @include('layouts.head_2')
@stop
@php
    date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_MX.UTF-8', 'esp');
    $fecha = strftime('%e de %B de %Y', strtotime(date('Y-m-d')));
    $att =
        "<div style='text-align:center;line-height: 1;'>
            <p>
                ATENTAMENTE <br>
                <b> “PIENSA Y TRABAJA”<br>
                    “1925-2025, Un Siglo de Pensar y Trabajar” </b><br>

                Zapopan, Jalisco, " .
        $fecha .
        "
            </p>
        </div>";
    $coordinador = "<p style='text-align:center;line-height: 1;'>
                <b>MTRO. VÍCTOR HUGO RAMÍREZ SALAZAR <br>
                    Coordinador de Tecnologías para el Aprendizaje</b>
            </p>";
@endphp
@section('content')
    @php
        $ruta = asset('js/es_MX.js');
    @endphp
    <script>
        tinymce.init({
            selector: 'textarea#cuerpo',
            content_style: "body, p { line-height: 1.4 !important; }",
            width: "100%",
            language: 'es_MX',
            language_url: '{{ $ruta }}',
            height: 500,
            plugins: 'table',
            menubar: true, // removes the menubar
        });

        tinymce.init({
            selector: 'textarea#ccp',
            content_style: "body, p { line-height: 1 !important; }",
            language: 'es_MX',
            language_url: '{{ $ruta }}',
            height: 150,
            resize: 'both',
            menubar: false,
            toolbar: false
        });
    </script>
    <div class="container">
        @if (Auth::check())
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row ">
                <h2 class="text-center my-3">Crear Oficio</h2>
            </div>
            <div>
                <form action="{{ route('oficios.store') }}" method="POST" class="row">
                    @csrf
                    <div class="my-1 col-sm-12 col-md-2">
                        <label for="num_oficio" class=" text-center">Oficio CTA</label>
                        <input type="text" class="text-center form-control" name="num_oficio" id="num_oficio"
                            value="{{ $oficio }}">
                    </div>

                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="dirigido">Dirigido</label>
                        <input type="text" placeholder="Dirigido" value="{{ old('dirigido') }}" class="form-control"
                            name="dirigido" id="dirigido">
                    </div>

                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="puesto_dirigido">Puesto Dirigido</label>
                        <input type="text" placeholder="Puesto a quien va dirigido" value="{{ old('puesto_dirigido') }}"
                            class="form-control" name="puesto_dirigido" id="puesto_dirigido">
                    </div>

                    <div class="my-1 col-sm-12 col-md-2">
                        <label for="centro_universitario">Centro Universitario</label>
                        <input type="text" placeholder="C.U." value="{{ old('centro_universitario') }}"
                            class="form-control text-center" name="centro_universitario" id="centro_universitario">
                    </div>

                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="atencion">Atención</label>
                        <input type="text" placeholder="Atención " value="{{ old('atencion') }}" class="form-control"
                            name="atencion" id="atencion">
                    </div>

                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="atencion">Puesto Atención</label>
                        <input type="text" placeholder="Puesto a quien va en Atención"
                            value="{{ old('puesto_atencion') }}" class="form-control" name="puesto_atencion"
                            id="puesto_atencion">
                    </div>
                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="atencion">Asunto</label>
                        <input type="text" placeholder="Asunto del oficio" value="{{ old('asunto') }}"
                            class="form-control" name="asunto" id="asunto">
                    </div>


                    <span class="text-muted my-1"><small>NOTA: Favor de introducir nombres completos del personal</small>
                    </span>

                    <hr>
                    <div class="col-md-12 p-2 ">
                        <label class="form-label" for="">Descripción</label>
                        <textarea class="form-control" name="cuerpo" placeholder="Cuerpo del oficio" id="cuerpo">
                            
                          {!! old('cuerpo') ? old('cuerpo') : "<br/>$att<br/><br/><br/>$coordinador" !!}

                        </textarea>
                    </div>
                    <div id="formulario">

                    </div>
                    <div class="col-md-3 col-sm-12">
                        <label for="agregar">C.c.p.</label>
                        <textarea class="form-control" id="ccp" name="con_copia">{{ old('con_copia') }} </textarea>
                        {{-- 
                        <button type="button" id="agregar" class="clonar btn btn-secondary btn-sm">+</button>
                        <label for="agregar">Agregar C.C.</label>
                         --}}
                    </div>

                    <div class="col-sm-12">
                        <button type="submit" class="my-2 btn btn-success">Guardar</button>
                    </div>


                </form>

            </div>
        @else
            El periodo de Registro de Proyectos a terminado
        @endif
    </div>
@endsection

@section('footer')
    <div class="row align-items-center">
        <h5 class="text-end">En caso de inconsistencias, favor de reportarlas.</h5>
    </div>
@endsection

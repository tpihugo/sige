@extends('adminlte::page')
@section('title', 'Editar Oficio')

@section('css')
    @include('layouts.head_2')
    @php
        $ruta = asset('js/es_MX.js');
    @endphp
    <script>
        tinymce.init({
            selector: 'textarea.cuerpo',
            content_style: "body, p { line-height: 1.5 !important; }",
            language: 'es_MX',
            language_url: '{{ $ruta }}',
            width: "100%",
            height: 500,
            plugins: 'table | pagebreak | preview',
            toolbar: 'pagebreak | preview',
            quickbars_selection_toolbar: false,
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
@stop
@section('content')
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
                <h2 class="text-center my-3">Editar Oficio</h2>
            </div>
            <div>
                <form action="{{ route('oficios.update', $oficio->id) }}" method="POST" class="row">
                    @csrf
                    @method('PUT')
                    <div class="my-1 col-sm-12 col-md-2">
                        <label for="num_oficio" class=" text-center">Oficio CTA</label>
                        <input type="text" class="text-center form-control" name="num_oficio" id="num_oficio"
                            value="{{ $oficio->num_oficio }}">
                    </div>

                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="dirigido">Dirigido</label>
                        <input type="text" placeholder="Dirigido" value="{{ $oficio->dirigido }}" class="form-control"
                            name="dirigido" id="dirigido">
                    </div>

                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="puesto_dirigido">Puesto Dirigido</label>
                        <input type="text" placeholder="Puesto a quien va dirigido"
                            value="{{ $oficio->puesto_dirigido }}" class="form-control" name="puesto_dirigido"
                            id="puesto_dirigido">
                    </div>

                    <div class="my-1 col-sm-12 col-md-2">
                        <label for="centro_universitario">Centro Universitario</label>
                        <input type="text" placeholder="C.U." value="{{ $oficio->centro_universitario }}"
                            class="form-control" name="centro_universitario" id="centro_universitario">
                    </div>

                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="atencion">Atención</label>
                        <input type="text" placeholder="Puesto a quien va en Atención" value="{{ $oficio->atencion }}"
                            class="form-control" name="atencion" id="atencion">
                    </div>

                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="atencion">Puesto Atención</label>
                        <input type="text" placeholder="Atención" value="{{ $oficio->puesto_atencion }}"
                            class="form-control" name="puesto_atencion" id="puesto_atencion">
                    </div>
                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="atencion">Asunto</label>
                        <input type="text" placeholder="Asunto del oficio" value="{{ $oficio->asunto }}"
                            class="form-control" name="asunto" id="asunto">
                    </div>
                    <span class="text-muted my-1"><small>NOTA: Favor de introducir nombres completos del personal</small>
                    </span>
                    <hr>
                    <div class="col-md-12 p-2 ">
                        <label class="form-label" for="">Descripción</label>
                        <textarea class="form-control cuerpo" name="cuerpo" placeholder="Cuerpo del oficio" id="oficio">
                            {!! $oficio->cuerpo !!}                            
                        </textarea>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <label for="agregar">C.c.p.</label>
                        <textarea class="form-control" id="ccp" name="con_copia">{!! $oficio->con_copia !!}  </textarea>
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
@push('scripts')
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
@endpush


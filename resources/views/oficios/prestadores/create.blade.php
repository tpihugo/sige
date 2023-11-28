@extends('adminlte::page')
@section('title', 'Crear Oficio Liberación')

@section('css')
    @include('layouts.head_2')
@stop
@section('content')
    <script src="https://cdn.tiny.cloud/1/83792vt0p2ntv8uaehq9hr5zxl05u8zv8n7fkyza9xnw4hqn/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            width: "100%",
            height: 500,
            menubar: false, // removes the menubar
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
                <h2 class="text-center my-3">Crear Oficio Liberación Prestador</h2>
            </div>
            <div>
                <form action="{{ route('oficios.store') }}" method="POST" class="row justify-content-end">
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
                            class="form-control" name="centro_universitario" id="centro_universitario">
                    </div>

                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="atencion">Atención</label>
                        <input type="text" placeholder="Puesto a quien va en Atención" value="{{ old('atencion') }}"
                            class="form-control" name="atencion" id="atencion">
                    </div>

                    <div class="my-1 col-sm-12 col-md-5">
                        <label for="atencion">Puesto Atención</label>
                        <input type="text" placeholder="Atención" value="{{ old('puesto_atencion') }}"
                            class="form-control" name="puesto_atencion" id="puesto_atencion">
                    </div>


                    <span class="text-muted my-1"><small>NOTA: Favor de introducir nombres completos del personal</small>
                    </span>
                    <hr>
                    <div class="col-md-12 p-2 ">
                        <label class="form-label" for="">Descripción</label>
                        <textarea class="form-control" name="cuerpo" placeholder="Cuerpo del oficio" id="oficio">
                            {{ $cuerpo }}                            
                        </textarea>
                    </div>
                    <div class="col-md-1 col-sm-1">
                        <button type="submit" class="my-2 btn btn-success">Guardar</button>
                    </div>

                </form>
                <div>
                    <h4 class="text-center">Lista de nombres segun su C.U.</h4>
                </div>
                <hr>

                <table class=" display text-center " style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">C.U.</th>
                            <th scope="col">Secretario Administrativo</th>
                            <th scope="col">Jefe Servicio Social</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>CUCSH</td>
                            <td>Lic. Xochitl Ferrer Sandoval</td>
                            <td>Lic. Alfredo Don Olivera</td>
                        </tr>
                        <tr>
                            <td>CUCEI</td>
                            <td>Mtra. Claudia Castillo Cruz</td>
                            <td>Lic. Lucero Araceli Rios Espinoza</td>
                        </tr>
                        <tr>
                            <td>CUCEA</td>
                            <td>Lic. Denisse Murillo González</td>
                            <td>Lic. Francisco Martínez Sánchez</td>
                        </tr>
                        <tr>
                            <td>CUTONALA</td>
                            <td>Mtra. Ana Fabiola del Toro García</td>
                            <td>Lic. Luis Humberto Gil Navarro</td>
                        </tr>
                        <tr>
                            <td>SUV</td>
                            <td>Mtra. Cynthia Ruano Méndez</td>
                            <td>Lic. Edson José Bolaños Rodríguez</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @else
            El periodo de Registro de Proyectos a terminado
        @endif
    </div>
@endsection

@section('footer')
    <div class="row g-3 align-items-center">
        <h6 class="text-end">En caso de inconsistencias, favor de reportarlas.</h6>
    </div>
@endsection

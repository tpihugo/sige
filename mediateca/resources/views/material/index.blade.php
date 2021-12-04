@if (Auth::user()->rol == 'Administrador')
    @extends('layouts.plantillabase')


    @section('css')

    @endsection


    @section('contenido')
        <br>

        <div class="card text-center">
            <div class="card-body bg-dark text-light">
                <h1 class="card-title ">Listado de material audiovisual.</h1>
            </div>
            <div class="d-flex justify-content-start card-footer text-muted bg-secondary">

                <div class="pull-left p-2">




                    <a href="#" class="exportar btn btn-primary">Exportar a CSV</a>
                    <a href="#" class="exportar btn btn-success">Exportar a Excel</a>
                    <a href="#" class="exportar btn btn-danger">Export PDF</a>
                    <a href="#" class="exportar btn btn-dark">Imprimir</a>
                    <a class="btn btn-light text-dark" data-bs-toggle="modal" data-bs-target="#modalRegistroNuevo"
                        data-bs-whatever="@new">Nuevo registro</a>




                </div>

            </div>
        </div>

        <br>
        <!-- Registro normal -->
        <div class="modal fade" id="modalRegistroNuevo" tabindex="-1" aria-labelledby="crear" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear nuevo registro</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="./material" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Titúlo</label>
                                <input type="text" class="form-control" name="titulo" id="titulo"
                                    aria-describedby="Titúlo" required>

                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control" name="descripcion" id="descripcion"
                                    aria-describedby="Descripción" required>

                            </div>
                            <div class="mb-3">
                                <label for="formato" class="form-label">Formato</label>
                                <input type="text" class="form-control" name="formato" id="formato"
                                    aria-describedby="Formato" required>

                            </div>
                            <div class="mb-3">
                                <label for="etiqueta" class="form-label">Etiqueta</label>
                                <input type="text" class="form-control" name="etiqueta" id="etiqueta"
                                    aria-describedby="Etiqueta" required>

                            </div>
                            <div class="mb-3">
                                <label for="tipo_material" class="form-label">Tipo de material</label>


                                <select name="tipo_material" id="tipo_material" class="form-select form-select-lg mb-3"
                                    aria-label=".form-select-lg example" Required>
                                    <option selected disabled>Selecciona tipo</option>
                                    <option value="Conferencia">Conferencia</option>
                                    <option value="Clase magistral">Clase magistral</option>
                                    <option value="Video conferencia">Video conferencia</option>
                                    <option value="Foro">foro</option>
                                    <option value="Transmisión en vivo">Transmisión en vivo</option>
                                </select>

                            </div>
                            <div class="mb-3">
                                <label for="duracion" class="form-label">Duración</label>
                                <input type="text" class="form-control" name="duracion" id="duracion"
                                    aria-describedby="Duración" placeholder="Ejemplo: HH:MM:SS" required>

                            </div>
                            <div class="mb-3">
                                <label for="anio_publicacion" class="form-label">Año de publicación</label>
                                <input type="date" class="form-control" name="anio_publicacion" id="anio_publicacion"
                                    aria-describedby="Año de publicación" required>

                            </div>
                            <div class="mb-3">
                                <label for="participantes" class="form-label">Participantes</label>
                                <input type="text" class="form-control" name="participantes" id="participantes"
                                    aria-describedby="Participantes" required>
                            </div>
                            <input type="hidden" class="form-control" name="inicio" id="inicio" value="0"
                                aria-describedby="inicio">
                            <input type="hidden" class="form-control" name="carousel" id="carousel" value="0"
                                aria-describedby="carousel">
                            <input type="hidden" class="form-control" name="activo" id="activo" value="1"
                                aria-describedby="activo">

                            <div class="file-loading">
                                <label for="file" class="form-label">Video</label>
                                <input id="file" name="file" type="file" class="form-control"
                                    placeholder="Coloca el video" required>
                            </div>
                            <div class="file-loading">
                                <label for="file_preview" class="form-label">Imagén de previsualización</label>
                                <input id="file_preview" name="file_preview" type="file" class="form-control"
                                    data-allowed-file-extensions='[".jpg", ".png",  ".jpeg"]' required>
                            </div>
                            <br>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- Fin registro normal -->




        <div class="table-responsive">

            <table id="material" class="table table-striped table-bordered dt-responsive nowrap shadow-lg mt-5"
                style="width:100%">


                <thead class="bg-dark text-white">
                    <tr>
                        <!-- <th scope="col">ID</th>  -->
                        <th scope="col">Título</th>

                        <th scope="col">Formato</th>
                        <th scope="col">Etiqueta</th>
                        <th scope="col">Tipo de material</th>
                        <th scope="col">Duración</th>
                        <th scope="col">Año de publicación</th>
                        <th scope="col">Participantes</th>
                        <th scope="col">Vista</th>

                        <th scope="col">Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($materials as $material)
                        @if ($material->activo == 1)

                            <tr>
                                <!-- <td>{{ $material->id }}</td>  -->
                                <td>{{ $material->titulo }}</td>

                                <td>{{ $material->formato }}</td>
                                <td>{{ $material->etiqueta }}</td>
                                <td>{{ $material->tipo_material }}</td>
                                <td>{{ $material->duracion }}</td>
                                <td>{{ $material->anio_publicacion }}</td>
                                <td>{{ $material->participantes }}</td>

                                <td>
                                    <div>
                                        @if ($material->inicio == 0)
                                            <form action="{{ route('activeIndex', $material->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input bg-danger" type="checkbox"
                                                        id="flexSwitchCheckChecked" onChange="this.form.submit()">
                                                    Inicio
                                                </div>

                                            </form>
                                        @endif
                                        @if ($material->inicio == 1)
                                            <form action="{{ route('notActiveIndex', $material->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input bg-success" type="checkbox"
                                                        id="flexSwitchCheckChecked" onChange="this.form.submit()" checked>
                                                    Inicio
                                                </div>

                                            </form>
                                        @endif
                                    </div>

                                    <div>
                                        @if ($material->carousel == 0)
                                            <form action="{{ route('carouselShow', $material->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input bg-danger" type="checkbox"
                                                        id="flexSwitchCheckChecked" onChange="this.form.submit()">
                                                    Carousel
                                                </div>
                                            </form>
                                        @endif
                                        @if ($material->carousel == 1)
                                            <form action="{{ route('carouselHidden', $material->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input bg-success" type="checkbox"
                                                        id="flexSwitchCheckChecked" onChange="this.form.submit()" checked>
                                                    Carousel
                                                </div>

                                            </form>
                                        @endif
                                    </div>
                                </td>

                                <td>
                                    <form action="{{ route('delete', $material->id) }}" method="POST">
                                        <a href="{{ route('material.edit', $material->id) }}" class="btn btn-success"><i
                                                class="fa fa-pencil" aria-hidden="true"></i></a>
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"
                                                aria-hidden="true"></i></button>

                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>





    @section('js')
        <script>
            $(document).ready(function() {
                table.destroy();
                responsive: true
                $('#material').DataTable({

                    dom: "Blfrtip",
                    columnDefs: [{
                        orderable: false,
                        targets: 1
                    }]
                });
            });
        </script> ___scripts_1___
        <script>
            $(document).ready(function() {
                table.destroy();
                $('#material').DataTable({

                    dom: "Blfrtip",
                    buttons: [{
                            text: 'csv',
                            extend: 'csvHtml5',
                            exportOptions: {
                                columns: ':visible:not(.not-export-col)'
                            }
                        },
                        {
                            text: 'excel',
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: ':visible:not(.not-export-col)'
                            }
                        },
                        {
                            text: 'pdf',
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: ':visible:not(.not-export-col)'
                            }
                        },
                        {
                            text: 'print',
                            extend: 'print',
                            exportOptions: {
                                columns: ':visible:not(.not-export-col)'
                            }
                        },

                    ],
                    columnDefs: [{
                        orderable: false,
                        targets: -1
                    }]
                });
            });
        </script> ___scripts_3___



    @endsection

@endsection
@else
<script>
    window.location.replace("http://sige.cucsh.udg.mx/mediateca/public/home");
</script>
@endif

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
                                    <option value="Foro">Foro</option>
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
                            <div class="text-center"><b>** NOTA: No usar ningun tipo de caracter especial (Ejemplos: &#193;, &#241;, &#243;, &#163;, &#169;, @)</b></div>
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
                                        <form action="{{ route('change_status', $material->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-check form-switch">
                                                @if ($material->inicio == 1)
                                                    <input  id="flexSwitchCheckChecked" class="form-check-input bg-success"
                                                        type="checkbox"  name="campo"
                                                        value='{{ 'inicio' . ',' . $material->inicio }}'
                                                        onChange="this.form.submit()"
                                                        />
                                                        <label for="">Inicio</label>


                                                @else
                                                    <input  id="flexSwitchCheckChecked" class="form-check-input bg-danger"
                                                        type="checkbox"  name="campo"
                                                        value='{{ 'inicio' . ',' . $material->inicio }}'
                                                        onChange="this.form.submit()"/>
                                                        <label for="">Inicio</label>
                                                @endif

                                            </div>

                                        </form>
				    </div>

                                    <div>
                                        <form action="{{ route('change_status', $material->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-check form-switch">
                                                @if ($material->carousel == 1)
                                                <input class="form-check-input bg-success"
                                                        type="checkbox"
                                                        onChange="this.form.submit()" name="campo"
                                                        value='{{ 'carousel' . ',' . $material->carousel }}' />
                                                        <label for="">Carousel</label>
                                                @else
                                                <input class="form-check-input bg-danger"
                                                        type="checkbox"
                                                        onChange="this.form.submit()" onclick="cambio(this)" name="campo"
                                                        value='{{ 'carousel' . ',' . $material->carousel }}'/>
                                                        <label for="">Carousel</label>
                                                @endif


                                            </div>
                                        </form>
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
        </script> <script>
        $(document).ready(function() {
            $('#material').DataTable({
                dom: "Blfrtip",
                buttons: [
                    {
                        text: 'csv',
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                        }
                    },
                    {
                        text: 'excel',
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                        }
                    },
                    {
                        text: 'pdf',
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                        }
                    },
                    {
                        text: 'print',
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                        }
                    },
                ],
                columnDefs: [{
                    orderable: false,
                    targets: -1
                }]
            });
        });
        </script>
        <script>

        $(".exportar").click(function() {
    var i = $(this).index() + 1
    console.log(i);
    var table = $('#material').DataTable();
    if (i == 1) {
        table.button('.buttons-csv').trigger();
    } else if (i == 2) {
        table.button('.buttons-excel').trigger();
    } else if (i == 3) {
        table.button('.buttons-pdf').trigger();
    } else if (i == 4) {
        table.button('.buttons-print').trigger();
    }
});
    </script>
    @endsection

@endsection
@else
<script>
    window.location.replace("http://sige.cucsh.udg.mx/mediateca/public/home");
</script>
@endif

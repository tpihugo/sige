
@extends('layouts.plantillabase')


@section('css')

@endsection


@section('contenido')
 <br>

 <div class="card text-center">
  <div class="card-body bg-dark text-light">
    <h1 class="card-title ">LISTADO DE USUARIOS.</h1>  
  </div>
  <div class="card-footer text-muted bg-secondary">
    <div class="pull-left p-2">
      <ul class="ul-dropdown">
        <li class="firstli">
            <i class="material-icons"></i><a href="#"> + Acciones</a>
            <ul>
              <li><a href="#">Exportar a CSV</a></li>
              <li><a href="#">Exportar a Excel</a></li>
              <li><a href="#">Export PDF</a></li>
              <li><a href="#">Imprimir</a></li>
              <li><a data-bs-toggle="modal" data-bs-target="#modalRegistroNuevo" data-bs-whatever="@new">Crear nuevo registro</a></li>
            </ul>
        </li>
      </ul>      
    </div>
  </div>
</div>      
  
<br>


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
    <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="Titúlo" required>

  </div>
  <div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="Descripción" required>

  </div>
  <div class="mb-3">
    <label for="formato" class="form-label">Formato</label>
    <input type="text" class="form-control" name="formato" id="formato" aria-describedby="Formato" required>

  </div>
  <div class="mb-3">
    <label for="etiqueta" class="form-label">Etiqueta</label>
    <input type="text" class="form-control" name="etiqueta" id="etiqueta" aria-describedby="Etiqueta" required>

  </div>
  <div class="mb-3">
    <label for="tipo_material" class="form-label">Tipo de material</label>


    <select name="tipo_material" id="tipo_material" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" Required>
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
    <input type="text" class="form-control" name="duracion" id="duracion" aria-describedby="Duración" required>

  </div>
  <div class="mb-3">
    <label for="anio_publicacion" class="form-label">Año de publicación</label>
    <input type="date" class="form-control" name="anio_publicacion" id="anio_publicacion" aria-describedby="Año de publicación" required>

  </div>
  <div class="mb-3">
    <label for="participantes" class="form-label">Participantes</label>
    <input type="text" class="form-control" name="participantes" id="participantes" aria-describedby="Participantes" required>
  </div>
  <input type="hidden" class="form-control" name="inicio" id="inicio" value="0" aria-describedby="inicio" >
<input type="hidden" class="form-control" name="carousel" id="carousel" value="0" aria-describedby="carousel" >

  <div class="file-loading">
  <label for="file" class="form-label">Video</label>
    <input id="file" name="file" type="file" class="form-control" data-allowed-file-extensions='[".mp4", ".avi", ]' required>
</div>
<div class="file-loading">
<label for="file_preview" class="form-label">Imagén de previsualización</label>
    <input id="file_preview" name="file_preview" type="file" class="form-control" data-allowed-file-extensions='[".jpg", ".png",  ".jpeg"]' required>
</div>
<br>

  <div class="modal-footer">
  <a href="/material" class="btn btn-secondary" tabindex="5">Cancelar</a>
  <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
  </div>
</form>
      </div>

    </div>
  </div>
</div>




      
<div class="container-fluid">
<table id="material" class="table table-responsive shadow-lg mt-5" style="width:100%">
<thead class="bg-dark text-white">
    <tr>
         <!-- <th scope="col">ID</th>  -->
        <th scope="col">Nombre</th>
        <th scope="col">Correo</th>
        <th scope="col">Rol</th>
       
        <!-- <th scope="col">Inicio</th>
        <th scope="col">Carousel</th> -->
        <th scope="col">Acciones</th>
    </tr>
</thead>
<tbody>

    @foreach($users as $users)
    <tr>
         <!-- <td>{{$users->id}}</td>  -->
        <td>{{$users->name}}</td>
        <td>{{$users->email}}</td>
        <td>{{$users->rol}}</td>
        
        
        <td>
        <form action="" method="POST">
            <a href="/material/{{$users->id}}/edit" class="btn btn-dark"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-dark"><i class="fa fa-trash" aria-hidden="true"></i></button>

        </form>
        </td> 
    </tr>

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
                    },
                    {
                        text: 'excel',
                        extend: 'excelHtml5',
                    },
                    {
                        text: 'pdf',
                        extend: 'pdfHtml5',
                    },
                    {
                        text: 'print',
                        extend: 'print',
                    },  
                ],
                columnDefs: [{
                    orderable: false,
                    targets: -1
                }] 
            });
        });
        </script> <script>
        $(document).ready(function() {
          table.destroy();
            $('#material').DataTable({
              
                dom: "Blfrtip",
                buttons: [
                    {
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

        </script> <script>  

        $("ul li ul li").click(function() {
    var i = $(this).index() + 1
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



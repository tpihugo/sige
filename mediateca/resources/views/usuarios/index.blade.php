@if (Auth::user()->rol == 'Administrador')


@extends('layouts.plantillabase')


@section('css')

@endsection


@section('contenido')
 <br>

 <div class="card text-center">
  <div class="card-body bg-dark text-light">
    <h1 class="card-title ">LISTADO DE USUARIOS</h1>
  </div>
  <div class="card-footer text-muted bg-secondary">
    <div class="pull-left p-2">
        <a href="#" class="exportar btn btn-primary">Exportar a CSV</a>
        <a href="#" class="exportar btn btn-success">Exportar a Excel</a>
        <a href="#" class="exportar btn btn-danger">Export PDF</a>
        <a href="#" class="exportar btn btn-dark">Imprimir</a>
    </div>
  </div>
</div>

<br>


<div class="container-fluid">
<table id="material" class="table table-responsive shadow-lg mt-5" style="width:100%">
<thead class="bg-dark text-white">
    <tr>
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
        <td>{{$users->name}}</td>
        <td>{{$users->email}}</td>
        <td>{{$users->rol}}</td>


        <td>
        <form action="{{route('profiles.delete',$users->id)}}" method="POST">
            <a href="{{route('profiles.edit',$users->id)}}" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>

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
        </script>
        <script>
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

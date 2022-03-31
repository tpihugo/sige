@extends('layouts.app')
@section('content')

<div class="container">
<<<<<<< HEAD
        @if(Auth::check())
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>

                </div>
            @endif


            <div class="row">
                <h2>Captura de requisición </h2>

                <hr>
                <script type="text/javascript">

                    $(document).ready(function() {
                        $('#js-example-basic-single').select2();
                        $('#equipos').select2();
                    });

                </script>

=======
    @if(Auth::check())
        @if (session('message'))
            <div class="alert alert-success">
                <h2>{{ session('message') }}</h2>
>>>>>>> 1448ce638473fea77923a53ab975230a86f4b1b7

            </div>
        @endif


<<<<<<< HEAD
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <label for="num_solicitud">Número Solicitud</label>
                                <input type="text" class="form-control" id="num_solicitud" name="num_solicitud" value="{{old('num_solicitud')}}" required>
                            </div>
                            <div class="col-md-6">
                            <label for="fecha_inicio">Fecha:</label>
=======
        <div class="row">
            <h2>Captura de requisición </h2>

            <hr>
            <script type="text/javascript">

                $(document).ready(function() {
                    $('#js-example-basic-single').select2();
                    // $('#equipos').select2();
                });

            </script>


        </div>

        <form action="{{route ('requisicions.store')}}" method="post" id="req_form" enctype="multipart/form-data" class="col-12">
            <div class="row">
                <div class="col">
                    {!! csrf_field() !!}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                            </ul>
                        </div>
                    @endif
                    <br>

                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <label for="num_solicitud">Numero de solicitud</label>
                            <input type="text" class="form-control" id="num_solicitud" name="num_solicitud" value="{{old('num_solicitud')}}" required>
                        </div>

                        <div class="col-md-4">
                            <label for="fecha">Fecha</label>
>>>>>>> 1448ce638473fea77923a53ab975230a86f4b1b7
                            <input type="date" class="form-control" id="fecha" name="fecha" value="{{old('fecha')}}" required>
                        </div>
<<<<<<< HEAD
                        <br>

                            <div class="col-md-12">
                                <label for="cargo">Proyecto</label>
                                <input type="text" class="form-control" id="proyecto" name="proyecto" value="{{old('proyecto')}}" required>
=======

                        <div class="col-md-4">
                            <label for="proyecto">Proyecto</label>
                            <input type="text" class="form-control" id="proyecto" name="proyecto" value="{{old('proyecto')}}" required >
                        </div>
                    </div>

                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <label for="fondo">Fondo</label>
                            <input type="text" class="form-control" id="fondo" name="fondo" value="{{old('fondo')}}" required >
                        </div>

                        <div class="col-md-4">
                            <label for="fecha_recibido">Fecha de recibo</label>
                            <input type="date" class="form-control" id="fecha_recibido" name="fecha_recibido" value="{{old('fecha_recibido')}}" required >
                        </div>

                        <div class="col-md-4">
                            <label for="quien_recibio">Receptor</label>
                            <input type="text" class="form-control" id="quien_recibio" name="quien_recibio" value="{{old('quien_recibio')}}" required >
                        </div>
                    </div>





                    <div class="row align-items-center">
                      <div class="col-md-6">
                          <a href="#add_article" class="btn btn-info" id="trigger_add_article" data-toggle="modal" data-target="#add_article" >Agregar articulo</a>
                      </div>

                        <!-- Modal: seleccion de articulos -->
                      <div class="modal fade" id="add_article" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title text-center"  id="exampleModalLabel">Articulo</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body" id="modal_body-select-article">

                            <div class="row align-items-center">
                              <div class="col-md-6">
                                <label for="all_codigos">Codigo</label>
                                <input type="text" class="form-control" name="codigo" id="all_codigos" placeholder="Ingrese numero">
                              </div>

                            <div class="col-md-6">
                              <label for="all_cantidades">Cantidad</label>
                              <input type="text" class="form-control" name="cantidad" id="all_cantidades" placeholder="Ingrese numero">
                            </div>

                            <div class="col-md-6">
                              <label for="all_descripciones">Descripción</label>
                              <input type="text" class="form-control" name="descripcion" id="all_descripciones">
>>>>>>> 1448ce638473fea77923a53ab975230a86f4b1b7
                            </div>

                            <div class="col-md-6">
                              <label for="all_observaciones">Observaciones</label>
                              <textarea class="form-control" name="observaciones" id="all_observaciones"> </textarea>
                            </div>

                          </div>
                          <input type="hidden" name="dataTable" id="dataTable">



                        </div>
<<<<<<< HEAD
                        <br>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="telefono">Fondo</label>
                                <input type="text" class="form-control" id="fondo" name="fondo" value="{{old('fondo')}}" required>
                            </div>

                            <div class="col-md-4">
                                <label for="fecha_inicio">Fecha Recibido:</label>
                                <input type="date" class="form-control" id="fecha_recibido" name="fecha_recibido" value="{{old('fecha_recibido')}}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="correo">Recibido por:</label>
                                <input type="text" class="form-control" id="quien_recibio" name="quien_recibio" value="{{old('quien_recibio')}}" required>
                            </div>
                           <!--  <div class="col-md-4">
                                <label for="correo">ID:</label>
                              {{--  <input type="text" class="form-control" id="id" name="id" value="{{old('id')}}" required>--}}
                            </div>
 -->


                        </div>

			<br>
			<div class="row g-3 align-items-center">
                        	<div class="col-md-6">


                            		<a href="{{ route('home') }}" class="btn btn-danger">Cancelar</a>
                            		<button type="submit" class="btn btn-success">Guardar datos</button>
                        	</div>
                    	</div>

                    </div>
                    <br>

                </div>
            </form>
            <br>
            <div class="row g-3 align-items-center">
=======
                        <div class="modal-footer">
                          <button type="button" class="btn btn-success" id="ready-add-article" data-dismiss="modal">Listo</button>
                        </div>
                      </div>
                    </div>
                  </div>

                    </div>
>>>>>>> 1448ce638473fea77923a53ab975230a86f4b1b7

                    <div class="row align-items-center" id="dataTableContainer" >

                      <!-- table(js) -->

                    </div>

               <br>
	                 <div class="row g-3 align-items-center">

                     <div class="col-md-6">
                         <a href="{{ route('home') }}" class="btn btn-danger">Cancelar</a>
                         <button type="submit" id="submit" class="btn btn-success">
                             Capturar
                             <i class="ml-1 fas fa-save"></i>
                         </button>
                     </div>

                	</div>

                </div>
                <br>

            </div>
        </form>



        <br>
        <div class="row g-3 align-items-center">

            <br>
            <h5>En caso de inconsistencias, favor de reportarlas.</h5>
            <hr>

        </div>
    </div>

<<<<<<< HEAD

=======
    <script type="text/javascript">

      var dataMatrix = [];
      document.getElementById('ready-add-article').addEventListener('click', function(){

          let tableContainer = document.getElementById('dataTableContainer');
          let data = '';

          temp = [document.getElementById('all_codigos').value,
                  document.getElementById('all_cantidades').value,
                  document.getElementById('all_descripciones').value,
                  document.getElementById('all_observaciones').value];

          dataMatrix.push(temp);

          for (let i = 0; i < dataMatrix.length; i++) {
            data += `
            <tr id="${i}">
              <th scope="row">${i+1}</th>
              <td>${dataMatrix[i][0]}</td>
              <td>${dataMatrix[i][1]}</td>
              <td>${dataMatrix[i][2]}</td>
              <td>${dataMatrix[i][3]}</td>
              <td> <a class="btn btn-outline-danger" role="button" onclick="delete_art(${i})">Eliminar</a> </td>
            </tr>`;
          }

          tableContainer.innerHTML =`
          <div class="col-md-10">
              <table class="table table-sm" >
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Codigo</th>
                      <th scope="col">Cantidad</th>
                      <th scope="col">Descripcion</th>
                      <th scope="col">Observaciones</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody id="parentNode">
                  ${data}
                  </tbody>
                  </table>
            </div>`;
      });
    </script>


    <script type="text/javascript">

      function delete_art(id){
        let row = document.getElementById(id);
        let parent = document.getElementById('parentNode');
        parent.removeChild(row);
        dataMatrix.splice(id,1);
      }

      const btnCapture = document.getElementById('submit');

      btnCapture.addEventListener('click',function(evt){
        let inputDataTable = document.getElementById('dataTable');
        inputDataTable.value = dataMatrix;
        inputDataTable.setAttribute('value', dataMatrix);
      });

      document.getElementById('trigger_add_article').addEventListener('click', function(){
        document.getElementById('all_codigos').value = '';
        document.getElementById('all_cantidades').value = '';
        document.getElementById('all_descripciones').value = '';
        document.getElementById('all_observaciones').value = '';
      });



    </script>
>>>>>>> 1448ce638473fea77923a53ab975230a86f4b1b7

    @else
        El periodo de Registro de Proyectos a terminado
    @endif




</div>

@endsection

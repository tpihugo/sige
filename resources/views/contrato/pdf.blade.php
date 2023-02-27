<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <title>Contrato. SIGE</title>
    
        <!-- Styles -->
    
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
        <link rel="stylesheet" href="{{ asset('css/contrato.css') }}">

        <style>
            .pie {
                font-size: 10px;
                text-align: right;
            }
    
            td {
                font-size: 12px;
            }

            .page-break {
                page-break-after: always;
            }
          
            
        </style>

        

    </head>
    <body>

        
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <p class="text-center"><img class="img-responsive" src="images/logo.jpg" width="100%"></p>
                </div>
            </div>
            <br> 
            
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <table class="table table-bordered">

                            <tr>
                                <th scope="col" colspan="10">
                                    <center>
                                        <h5 class="position-relative text-uppercase text-primary" >Folio: {{ $prestamo->id }}</h5>
                                    </center>
                                </th>
                            </tr>
                
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" colspan="10">
                                    <center>
                                        <h5 class="position-relative text-primary">Formato de solicitud de préstamo de equipo de cómputo</h5>
                                    </center>
                                </th>
                            </tr>
                        </thead>
                        <tr>               
                            <td colspan="10"><b>1.- Datos de Solicitante</b></td>
                        </tr>
                        <tr>               
                            <td colspan="10"><b>Nombre del Solicitante:</b> {{ $prestamo->solicitante }} </td>
                        </tr>
                        <tr>
                            <td colspan="5"><b>Contacto: </b> {{$prestamo->contacto}}</td>
                            <td colspan="5"><b>Cargo: </b>{{ $prestamo->cargo }}</td>
                        </tr>
                        <tr>
                            <td colspan="10"><b>Área: </b>{{ $prestamo->lugar }}</td>

                        </tr>


                    </table>

                </div>
            </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                   
                            <table class="table table-bordered">
                            
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" colspan="7">
                                <center>
                                    <h5 style="" class="position-relative text-primary">Equipo en préstamo</h5>
                                 </center>
                            </th>
                        </tr>
                    </thead>
                    </tr>
                    </tr>

               <tbody>       
                            <tr class="position-relative text-uppercase text-primary" >
                                <td class="letter_table"><b>Id SIGE</b></td>
                                <td class="letter_table"><b>IdUdeG</b></td>
                                <td class="letter_table"><b>Tipo Equipo</b></td>
                                <td class="letter_table"><b>Marca</b></td>
                                <td class="letter_table"><b>Modelo</b></td>
                                <td class="letter_table" ><b>N/S</b></td>
                                <td class="letter_table"><b>Accesorios</b></td>
                            </tr>
                            @foreach ($equiposPorPrestamo as $item)
                                <tr style="outline: thin solid">
                                    <td>{{ $item->id_equipo }}</td>
                                    <td>{{ $item->udg_id }}</td>
                                    <td>{{ $item->tipo_equipo }}</td>
                                    <td>{{ $item->marca }}</td>
                                    <td>{{ $item->modelo }}</td>
                                    <td>{{ $item->numero_serie }}</td>
                                    <td >{{ $item->accesorios }}</td>
                                </tr>
                            @endforeach
                          
                          
                            <tr>               
                                <td colspan="7"><b>Observaciones: </b>{{ $prestamo->observaciones }}</td>
                            </tr>
                            <tr>               
                                <td colspan="7"><b>Cantidad de dispositivos:</b> {{$contador_consulta}} </td>
                            </tr>
                            
                    </tbody>
                </table>
                          
                </div>

            </div>

            <div class="row">
                <div class="col-md-12 col-xs-12">
           
                    <table class="table table-bordered">
                    
            <thead class="thead-light">
                <tr>
                    <th scope="col" colspan="7">
                        <center>
                            <h5 class="position-relative text-primary">Fecha préstamo / devolución</h5>
                        </center>
                    </th>
                </tr>
            </thead>
            </tr>
            </tr>
       
              
        </tbody>
            <tr>
                <td colspan="5"><b>Fecha de préstamo: </b> {{ \Carbon\Carbon::parse($prestamo->fecha_inicio)->format('d/m/Y') }}</td>
                
                <td colspan="2"><b>Fecha de devolución: </b>{{ $fechaProxima->format('d/m/Y') }}</td>
            </tr>
  
            <tr>
                <td colspan="7"><b>* Nota: </b>Entregar en el siguiente día hábil después de la fecha de devolución.</td>
            </tr>
            </table>

                
                
            
            
        </div>

    </div>

            <div class="page-break"></div>
            <center>
            <div class="position-relative d-flex align-items-center justify-content-center">
                <h1 class=" text-white" style="-webkit-text-stroke: 1px #dee2e6; font-size: 380%">REGLAMENTO</h1>
            </div>
        </center>

        </div>
    </div>
    
</div>

            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <table style=" border: 0px" class="table border border-white">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" colspan="10">
                                    <center>                
                                        <h5 class="position-relative text-uppercase text-primary" style="font-size: 150%">PRÉSTAMO DE EQUIPO</h5>
                                    </center>
                                </th>
                            </tr>
                        </thead>
        <tr> 
            
            <br><br>
            <td colspan="1">          
                <div class="col-lg-2">
                    <div class="border-left border-primary pt-2 pl-4 ml-2">

                            <p class="letter_size_2"><span class="font-weight-bold letter_size_2">1 -</span> El equipo de cómputo portátil es para uso exclusivo de los estudiantes del Centro Universitario de Ciencias Sociales y Humanidades.</p>
        
                            <p class="letter_size_2"><span class="font-weight-bold letter_size_2">2 -</span> El alumno que solicite el préstamo del equipo portátil será responsable de su buen uso. Cuando el alumno regrese el equipo al personal de CTA, se asegurará de revisar que el equipo sea regresado en buen estado, de igual manera, el personal de dicha coordinación hará las revisiones correspondientes al equipo.</p>

                            <p class="letter_size_2"><span class="font-weight-bold letter_size_2">3 -</span> La Secretaría Académica, a través de la Coordinación de Tecnologías para el Aprendizaje, administrará el servicio de préstamo de equipos portátiles a la comunidad estudiantil. Asimismo, el servicio de préstamo estará sujeto a la disponibilidad de computadoras portátiles y a las Políticas y Criterios Institucionales sobre el préstamo de equipo de cómputo.</p>

                            <p class="letter_size_2"><span class="font-weight-bold letter_size_2">4 -</span> No se prestará el equipo a las personas que no puedan acreditarse como alumnos vigentes del CUCSH.</p>

                            <p class="letter_size_2"><span class="font-weight-bold letter_size_2">5 -</span> El servicio de préstamo de equipo podrá ser solicitado únicamente para actividades de tipo académico.</p>

                            <p class="letter_size_2"><span class="font-weight-bold letter_size_2">6 -</span> El alumno podrá utilizar el equipo de cómputo en el lapso de tiempo que considere pertinente para realizar todas sus actividades académicas, sin embargo, el equipo deberá ser devuelto a más tardar en la fecha que marca el calendario escolar oficial de la Universidad para el periodo de extraordinarios del mismo ciclo escolar correspondiente al préstamo. Esto con la finalidad de hacer el servicio correspondiente al equipo y pueda ser prestado a los alumnos que lo necesiten en los siguientes semestres y/o clases del próximo periodo estudiantil.</p>

           
                        <p class="letter_size_2"><span class="font-weight-bold letter_size_2">7 -</span> El alumno deberá obligatoriamente cumplir con los siguientes requisitos para que le sea autorizado el préstamo:</p>
                   
                                <div class="row mb-1">
                                    <ul>
                                        <li> <p class="letter_size_2 mb-1">Presentar y dejar copia de credencial del INE vigente.</p></li>
                                        <li> <p class="letter_size_2 mb-1">Copia de su horario de clases que lo acredite como estudiante del CUCSH.</p></li>
                                        <li> <p class="letter_size_2 mb-1">Llenar y firmar el formato de solicitud de préstamo de equipo que será elaborado por la Coordinación de Tecnologías para el Aprendizaje (CTA).</p></li>
                                        <li> <p class="letter_size_2 mb-1">Regresar el equipo en el periodo estipulado en la solicitud de préstamo, o a más tardar en el periodo mencionado anteriormente en este Reglamento.</p></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    
                </td>
           
            </tr>
            </table>
        </div>
    </div>

    
    <div class="page-break"></div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <table style=" border: 0px" class="table border border-white">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" colspan="10">
                            <center>                
                                <h5 class="position-relative text-uppercase text-primary" style="font-size: 150%">PRÉSTAMO DE EQUIPO</h5>
                            </center>
                        </th>
                    </tr>
                </thead>
<tr> 
    <td colspan="1">          
        <div class="col-lg-2">
            <div class="border-left border-primary pt-2 pl-4 ml-2">
                
                       <p class="letter_size_2"><span class="font-weight-bold letter_size_2">8 -</span> En caso de daño, robo o extravío del equipo de cómputo o de cualquiera de sus accesorios, el Alumno deberá acudir en TIEMPO y FORMA a las instalaciones de la Coordinación de Tecnologías para el Aprendizaje (CTA) para que se le pueda dar el seguimiento adecuado al suceso.</p>

                        <p class="letter_size_2"> <span class="font-weight-bold letter_size_2">9 -</span> El usuario deberá estar de acuerdo con el presente reglamento y firmar aceptando todos los términos y condiciones estipulados en el mismo. Bajo ninguna circunstancia el usuario podrá deslindarse de la responsabilidad que le confiere el presente reglamento y el formato de préstamo.</p>
   
                    </div>
                </div>
            
        </td>
   
    </tr>
    </table>
</div>
</div>
             
                <div style="margin-bottom: 40%"></div>
                    {{-- <br><br><br><br><br><br><br><br><br><br><br><br>
 --}}

                            <table class="table border border-white">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" colspan="10">
                                            <center>                
                                                <h5 class="position-relative text-uppercase text-primary" style="font-size: 100%">Nota: Firmar al calce y al final de la hoja.</h5>
                                            </center>
                                        </th>
                                    </tr>
                                </thead>
                            </div>
                                <tr>
                                    <td colspan="5">          
                                    <div class="col-lg-2">
                                        <br><br><br><br><br><br><br>
                                        <center>
                                            <div class="letter_size"><h6><span class="text-secondary letter_size">___________________________________</span></h6></div>
                                            <div class="letter_size"><h6><span class="letter_size">Nombre y Firma del Responsable del Préstamo</span></h6></div>
                                        </center>
                                    </div>
                                </td>
                                    <td colspan="5"> 
                                        <div class="col-lg-2"> 
                                            <br><br><br><br><br><br><br>   
                                            <center>   
                                                <div class="letter_size"><h6><span class="text-secondary letter_size">___________________________________</span></h6></div>         
                                                <div class="letter_size"><h6><span class="text-secondary letter_size">Nombre y Firma del Alumno</span></h6></div>
                                            </center>
                                        </div>
                                    </td>
                                </tr>
        
                            </table>
                        
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <br>
                                    <br>
            
                                 
                                    <p class="pie">Hora y día de Impresión: {{ date('d-m-Y H:i:s') }}<br>
                                        Realizado por: {{ Auth::user()->name }}<br>
                                        Reglamento para préstamo de equipos de Cómputo<br>
                                        Formato CTA-012. Actualización: 15/diciembre/2022</p>
                                </div>
                            </div>
                            
                            <script type="text/php">
                                if ( isset($pdf) ) {
                                    $pdf->page_script('
                                        $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                                        $pdf->text(270, 795, "Página $PAGE_NUM de $PAGE_COUNT", $font, 10);
                                    ');
                                }
                            </script>

</body>
</html>
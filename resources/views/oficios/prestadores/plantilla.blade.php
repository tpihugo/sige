@php
    date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_VE.UTF-8', 'esp');
    $anio = date('Y');
    $fecha = strtotime(date('Y-m-d'));
@endphp
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
        CUCSH/SA/CTA/{{ $oficio->num_oficio }}/{{ $anio }}
    </title>
    <style>
        footer {
            position: fixed;
            left: 0px;
            right: 0px;
            height: 50px;
            bottom: 0px;
            text-align: center;
            line-height: 35px;
        }
    </style>
</head>

<body>
    <div>
        <div>
            <img src="{{ asset('images/Logo-udg.png') }} " width="75px"
                style="float:left;margin-right:20px; padding-right:20px; border-right:solid grey; 2px">
            <p style="margin-top: 30px; ">UNIVERSIDAD DE GUADALAJARA <br>
                CENTRO UNIVERSITARIO DE CIENCIAS SOCIALES Y HUMANIDADES <br>
                SECRETARÍA ACADÉMICA | Coordinación de Tecnologías para el Aprendizaje</p>
        </div>
        <div class="row" style="clear: both; margin-top:50px;text-align:right;">
            <div class="col-auto ">
                CUCSH/SA/CTA/{{ $oficio->num_oficio }}/{{ $anio }}
            </div>
        </div>
        <div>
            <span>
                {{ Str::upper($oficio->dirigido) }}<br>

                SECRETARIO ACADÉMICO DEL {{ $oficio->centro_universitario }} <br>
                PRESENTE
            </span>
        </div>
        @if (isset($oficio->atencion))
            <div class="row" style="text-align:right;">
                <span class="text-end">
                    @php
                        $oficio->atencion = 'At´n: ' . $oficio->atencion;
                    @endphp
                    {{ Str::upper($oficio->atencion) }}
                    <br>
                    Jefe de la Unidad de Servicio Social del {{ $oficio->centro_universitario }}
                </span>
            </div>
        @endif



        <div style="margin-top:30;">
            {!! $oficio->cuerpo !!}
        </div>

        <div style="text-align: center;padding-top:50px;">
            <p>
                ATENTAMENTE <br>
                <b> “PIENSA Y TRABAJA” </b><br>
                “2023, AÑO DEL FOMENTO A LA FORMACIÓN INTEGRAL <br>
                CON UNA RED DE CENTROS Y SISTEMAS MULTITEMÁTICOS” <br>

                Guadalajara, Jalisco, {{ strftime('%e de %B de %Y', $fecha) }}
            </p>
        </div>
        <table>

        </table>
    </div>

    <div>
        <p style="text-align: center;margin-top:150px;">
            <b>MTRO. VICTOR HUGO RAMIREZ SALAZAR <br>
                Coordinador de Tecnologías para el Aprendizaje</b>
        </p>
    </div>
    <footer class="text-muted" style="margin: 50px auto auto auto;text-align:center;">
        Av. Parres Arias #150 Colonia San José del Bajío C.P. 45132 Zapopan, Jal. Edificio E Piso 2, <br> Tel. (33)
        38193300
        Ext. 23700
    </footer>
</body>

</html>

@php
    date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_MX.UTF-8', 'esp');
    $anio = date('Y');
    $fecha = strtotime(date('Y-m-d'));
    $img = asset('images/Logo-udg.png');
    $cuerpoLen = strlen($oficio->cuerpo);
    if ($cuerpoLen > 500) {
        $estilosCuerpo = 'margin-top:50px; margin-bottom:0px;text-align:justify; ';
        $estilosNombre = 'text-align: center;margin-top:80px;';
        $estilosAtentamente = 'text-align: center;margin-top:50px;';

        $footer = 'position:fixed; !important';
    } else {
        $estilosCuerpo = 'margin-top:50px; margin-bottom:auto;text-align:justify; ';
        $estilosNombre = 'text-align: center;';
        $estilosAtentamente = 'text-align: center;margin-top:120px;';
        $footer = 'page-break';
    }

@endphp
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>CUCSH/SA/CTA/{{ $oficio->num_oficio }}/{{ $anio }}</title>
    <style>
        footer {
            position: relative;
            left: 0px;
            right: 0px;
            height: auto;
            bottom: 0px;
            text-align: center;
            line-height: 35px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div>
        <div>
            <img src="{{ $img }}" width="75px"
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
                <b>
                    {{ Str::upper($oficio->dirigido) }}<br>

                    {{ Str::upper($oficio->puesto_dirigido) }}<br> {{ Str::upper($oficio->centro_universitario) }} <br>
                    PRESENTE
                </b>

            </span>
        </div>
        @if (strcmp($oficio->atencion, '') != 0)
            <div class="row" style="text-align:right;">
                <span class="text-end">
                    @php
                        $oficio->atencion = 'At´n: ' . $oficio->atencion;
                    @endphp
                    {{ Str::upper($oficio->atencion) }}
                    <br>
                    {{ Str::upper($oficio->puesto_atencion) }}
                </span>
            </div>
        @endif

        <div style="{{ $estilosCuerpo }}">
            {!! $oficio->cuerpo !!}
        </div>

    </div>

    <footer class="text-muted" style="margin-top:auto;text-align:center;line-height: 1; {{ $footer }}">
        <div>
            <p>
                ATENTAMENTE <br>
                <b> “PIENSA Y TRABAJA”<br>
                    “30 años de la Autonom&iacute;a de la <br>
                    Universidad de Guadalajara y de su organizaci&oacute;n en Red” </b><br>

                Zapopan, Jalisco, {{ strftime('%e de %B de %Y', $fecha) }}
            </p>
        </div>
        @if (strcmp($oficio->con_copia, '-') != 0 && isset($oficio->con_copia))
            <div id="c_copia" style="font-size: 10px; text-align:left;">
                <p>
                <table>
                    @php
                        $temp = explode('@', $oficio->con_copia);
                    @endphp
                    @foreach (collect($temp) as $item)
                        <tr>
                            <td>
                                c.c. {{ $item }}
                            </td>
                        </tr>
                    @endforeach
                </table>

                </p>

            </div>
        @endif
        <div style="padding-top: 13%">
            <p>
                <b>MTRO. VICTOR HUGO RAMIREZ SALAZAR <br>
                    Coordinador de Tecnologías para el Aprendizaje</b>
            </p>
            <p>Av. Parres Arias #150 Colonia San José del Bajío C.P. 45132 Zapopan, Jal. Edificio E Piso 2, <br> Tel.
                (33)
                38193300
                Ext. 23700</p>
        </div>


    </footer>
    <script></script>
</body>

</html>

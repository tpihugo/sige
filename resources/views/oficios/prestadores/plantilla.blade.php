@php
    date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_MX.UTF-8', 'esp');
    $anio = explode('-', $oficio->created_at)[0];
    $fecha = strtotime(date('Y-m-d'));
    $img = asset('images/Logo-udg.png');
@endphp
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>CUCSH/SA/CTA/{{ $oficio->num_oficio }}/{{ $anio }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <style>
        @page {
            margin-top: 10px;
            size: letter;
            margin-bottom: 50mm;
        }

        #header {
            position: fixed;
            top: 0px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            line-height: 35px;
        }

        * {
            margin-bottom: 0px !important;
        }

        main {
            margin-bottom: 40px !important;
        }


        .pie {
            font-size: 10px;
            text-align: center;
            margin-top: 10px;
        }

        #footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            border-top: 1px solid gray;
            /* Borde superior */
            padding-top: 5px;
            height: 1.5cm;
        }
    </style>
</head>


<body>
    <header id="header">
        <div style="height: 100%">
            <img src="{{ $img }}" width="75px"
                style="float:left;margin-right:20px; padding-right:20px; border-right:solid grey; 2px">
            <p style="margin-top: 30px; line-height:1;font-size:16px;">UNIVERSIDAD DE GUADALAJARA <br>
                CENTRO UNIVERSITARIO DE CIENCIAS SOCIALES Y HUMANIDADES <br>
                SECRETARÍA ACADÉMICA <br> COORDINACIÓN DE TECNOLOGÍAS PARA EL APRENDIZAJE</p>
        </div>
    </header>

    <footer id="footer">

    </footer>

    <main style="clear: both;">
        <div style="text-align:right;">
            <div class="col-auto ">
                CUCSH/SA/CTA/{{ $oficio->num_oficio }}/{{ $anio }}
            </div>
        </div>

        <div style="width:100%;margin-top:1cm;">
            <span style="line-height:1;overflow-wrap: break-word;width:100%">
                <b>
                    {{ Str::upper($oficio->dirigido) }}<br>

                    {{ strcmp($oficio->puesto_dirigido, '-') != 0 ? Str::upper($oficio->puesto_dirigido) : '' }}<br>
                    {{ Str::upper($oficio->centro_universitario) }}
                    <br>
                    PRESENTE
                </b>
            </span>
        </div>
        @if (strcmp($oficio->atencion, '') != 0)
            <div style="text-align:right;">
                <span class="text-end">
                    @php
                        $oficio->atencion = 'Atención: ' . $oficio->atencion;
                    @endphp
                    {{ Str::upper($oficio->atencion) }}
                    <br>
                    {{ Str::upper($oficio->puesto_atencion) }}
                </span>
            </div>
        @endif


        <div style="margin-top:15px;  margin-bottom:1.10cm !important; padding-bottom:15px; width:100%;">
            {!! $oficio->cuerpo !!}
        </div>

        @if (strcmp($oficio->con_copia, '-') != 0 && isset($oficio->con_copia))
            <div style="font-size: 10px; text-align:left;">
                {!! $oficio->con_copia !!}
            </div>
        @endif
    </main>
</body>

</html>

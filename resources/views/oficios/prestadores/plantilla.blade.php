@php
    date_default_timezone_set('America/Mexico_City');
    setlocale(LC_TIME, 'es_MX.UTF-8', 'esp');
    $anio = explode('-', $oficio->created_at)[0];
    $fecha = strtotime(date('Y-m-d'));
    $img = asset('images/logo_nuevo.png');

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
        @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            src: url('{{ asset('fonts/Montserrat-Regular.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 700;
            src: url('{{ asset('fonts/Montserrat-Bold.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Times New Roman';
            font-style: normal;
            font-weight: 700;
            src: url('{{ asset('fonts/Times New Roman Bold.ttf') }}') format('truetype');
        }

        body {
            font-family: 'Montserrat';
            font-size: 10pt;
        }

        @page {
            margin-top: 10px;
            size: letter;
            margin-bottom: 50mm;
        }

        .bold-text {
            font-weight: bold;
        }

        #header {
            position: fixed;
            top: 0px;
            left: 0px;
            right: 0px;
            height: 50px;
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

        .titulo {
            font-family: "Times New Roman", "Monserrat";
            font-size: 11pt;
        }
    </style>
</head>
<body>
    <header id="header">
        <div style="height: 100%">
            <img src="{{ $img }}" height="100px" style="float:left;margin-right:20px; padding-right:20px;">
            <p style="margin-top: 30px;line-height:.8;">
                <span class="bold-text titulo">UNIVERSIDAD DE GUADALAJARA </span><br>
                <span style="color:#7D91BE;font-size: 10pt;" class="bold-text"> CENTRO UNIVERSITARIO DE CIENCIAS
                    SOCIALES Y HUMANIDADES</span> <br>
                <span style="font-size: 8pt;">SECRETARÍA ACADÉMICA</span> <br>
                <span style="font-size: 8pt;">COORDINACIÓN DE TECNOLOGÍAS PARA EL APRENDIZAJE</span>
            </p>
        </div>
    </header>

    <footer id="footer">

    </footer>

    <main style="clear: both;">
        <div style="text-align:right;">
            <div class="col-auto ">
                CUCSH/SA/CTA/{{ $oficio->num_oficio }}/{{ $anio }}
            </div>.
        </div>
        <div style="width:100%;margin-top:1cm;">
            <p style="line-height:.8;overflow-wrap: break-word;" class="bold-text">

                {{ Str::upper($oficio->dirigido) }}<br>

                {{ strcmp($oficio->puesto_dirigido, '-') != 0 ? Str::upper($oficio->puesto_dirigido) : '' }}<br>
                {{ Str::upper($oficio->centro_universitario) }} <br>
                PRESENTE

            </p>
        </div>
        @if (isset($oficio->atencion))
            <div style="text-align:right;line-height:1;">
                <p class="text-end">
                    @php
                        $oficio->atencion = 'Atención: ' . $oficio->atencion;
                    @endphp
                    {{ Str::upper($oficio->atencion) }}
                    <br>
                    {{ Str::upper($oficio->puesto_atencion) }}
                </p>
            </div>
        @endif
        <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>

        <div style="margin-top:15px;  margin-bottom:1.10cm !important; padding-bottom:15px; width:100%;">
            {!! $oficio->cuerpo !!}
        </div>

        @if (isset($oficio->con_copia))
            <div style="font-size: 10px; text-align:left;">
                {!! $oficio->con_copia !!}
            </div>
        @endif
    </main>
</body>

</html>

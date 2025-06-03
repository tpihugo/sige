<?php

namespace App\Http\Controllers;

use App\Exports\OficiosExport;
use App\Mail\RespuestaAlumnos;
use App\Models\Oficios; //
use App\Models\User;
use Dompdf\Cpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Excel;

class OficiosController extends Controller
{
    public $messages = [
        'dirigido.required' => 'Favor de ingresar a quien va dirigido',
        'num_oficio.required' => 'Favor de ingresar el número de oficio',
        'dirigido.starts_with' => 'Favor de incluir el titulo académico de a quien va dirigido',
        'atencion.required' => 'Favor de ingresar a quien va con atención',
        'atencion.starts_with' => 'Favor de incluir el titulo académico de a quien va dirigido',
        'asunto.required' => 'Favor de incluir el asunto'
    ];

    public function index() {}

    public function inicio($anio = null)
    {
        $anio = $anio == null ? date('Y') : $anio;

        $anios = array_keys(Oficios::select('created_at')
            ->where('activo', 1)
            ->get()
            ->groupBy('anio')
            ->toArray());

        $oficios = Oficios::where('activo', 1)->where('asunto', '!=', 'Oficio de Titulación')
            ->where('created_at', 'like', $anio . '%')
            ->get();

        return view('oficios.index', compact('oficios', 'anios', 'anio'));
    }

    public function create()
    {
        $anio = date('Y');

        $id = Oficios::select('num_oficio')
            ->where('activo', 1)->where('created_at', 'like', $anio . '%')
            ->latest()
            ->first();

        $oficio = isset($id) ? $id->num_oficio + 1 : 1;
        $cuerpo = view('oficios.prestadores.cuerpo')->render();
        //$plantilla = view('oficios.prestadores.plantilla', compact("cuerpo"))->render();
        return view('oficios.prestadores.create', compact('cuerpo', 'oficio'));
    }
    public function show(Oficios $oficio)
    {
        $html = view('oficios.prestadores.plantilla', compact('oficio'));
        $pdf = \PDF::loadHtml($html->render())->setPaper('letter', 'portrait');
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->get_canvas();
        $width = $canvas->get_width();
        $x_center = ($width / 2) - 50; // Ajusta según el ancho del texto

        $canvas->page_text(150, 750, "Av. Parres Arias #150 Colonia San José del Bajío C.P. 45132 Zapopan, Jal.", null, 10, [0, 0, 0]);
        $canvas->page_text(200, 760, "Edificio E Piso 2, Tel. (33) 38193300 Ext. 23700", null, 10, [0, 0, 0]);
        $canvas->page_text($x_center, 770, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, [0, 0, 0]);


        return $pdf->stream();
    }
    public function edit(Oficios $oficio)
    {
        return view('oficios.edit', compact('oficio'));
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'num_oficio' => 'required',
                'dirigido' => 'required',
                'asunto' => 'required'
            ],
            $this->messages,
        );

        $oficio = new Oficios();
        $oficio->activo = '1';
        $anio = date('Y');

        $id = Oficios::select('num_oficio')
            ->where('activo', 1)->where('created_at', 'like', $anio . '%')
            ->latest()
            ->first();

        $oficio->num_oficio = isset($id) ? $id->num_oficio + 1 : 1;
        foreach ($request->request as $key => $value) {
            if (!is_null($value) && strcmp('_token', $key) != 0 && strcmp('_method', $key) != 0 && strcmp('con_copia', $key) != 0 && strcmp('num_oficio', $key) != 0) {
                $oficio->$key = $request->$key;
            }
        }

        $oficio->con_copia = $request->con_copia;
        //return $oficio;
        $oficio->save();
        $anio = date('Y');
        return redirect()->route('oficios.inicio', $anio);
    }

    public function update(Request $request, Oficios $oficio)
    {

        foreach ($request->request as $key => $value) {
            if (!is_null($value) && strcmp('_token', $key) != 0 && strcmp('_method', $key) != 0 && strcmp('con_copia', $key) != 0) {
                $oficio->$key = $request->$key;
            }
        }
        $oficio->con_copia = $request->con_copia;
        $oficio->update();

        $anio = date('Y');
        return redirect()->route('oficios.inicio', $anio);
    }

    public function general()
    {
        $anio = date('Y');

        $id = Oficios::select('num_oficio')
            ->where('activo', 1)->where('created_at', 'like', $anio . '%')
            ->latest()
            ->first();

        $oficio = isset($id) ? $id->num_oficio + 1 : 1;
        return view('oficios.oficios.create', compact('oficio'));
    }

    public function oficios_titulacion()
    {
        $oficios_titulacion =  DB::connection('mysql2')->table('oficios_titulacion')->select('id', 'name', 'codigo', 'carrera', 'email', 'estatus')
            ->where('enviado', 1)->where('estatus', '=', null)->get();

        return view('oficios.titulacion.index', compact('oficios_titulacion'));
    }
    public function oficios_titulacion_notificar(Request $request)
    {

        if (strcmp($request->estatus, 'aceptar') == 0) {

            $anio = date('Y');

            $id = Oficios::select('num_oficio')
                ->where('activo', 1)->where('created_at', 'like', $anio . '%')
                ->latest()
                ->first();

            $numero = isset($id) ? $id->num_oficio + 1 : 1;
            $oficio = Oficios::updateOrCreate(
                ['dirigido' => $request->nombre, 'asunto' => 'Oficio de Titulación', 'activo' => 1],
                [
                    'num_oficio' => $numero,
                    'dirigido' => $request->nombre,
                    'asunto' => 'Oficio de Titulación',
                    'atencion' => '-',
                    'centro_universitario' => 'CUCSH',
                    'cuerpo' => 'Oficio para titulación'
                ]
            );
            $num_oficio = $oficio->id;
            $usuario = DB::connection('mysql2')->table('users')->where('id', $request->id)->first();
            Mail::to($usuario->email)->send(new RespuestaAlumnos($usuario));
            return $usuario;
        } else {
            $num_oficio = "No aceptado";
        }
        //dd((strcmp($request->estatus, 'aceptar') == 0) ? 0 : 1);

        DB::connection('mysql2')->table('oficios')->updateOrInsert(
            ['user_id' => $request->id],
            [
                'user_id' => $request->id,
                'num_oficio' => $num_oficio,
                'estatus' => (strcmp($request->estatus, 'aceptar') == 0) ? 1 : 0
            ]

        );
        return redirect()->route('oficios.titulacion');
    }
}

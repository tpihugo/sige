<?php

namespace App\Http\Controllers;

use App\Exports\OficiosExport;
use App\Models\Oficios;//
use Dompdf\Cpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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
    ];
    public function index()
    {
    }

    public function inicio($anio = null)
    {
        $anio = $anio == null ? date('Y') : $anio;

        $anios = array_keys(Oficios::select('created_at')
            ->where('activo', 1)
            ->get()
            ->groupBy('anio')
            ->toArray());

        $oficios = Oficios::where('activo', 1)
            ->where('created_at', 'like', $anio . '%')
            ->get();

        return view('oficios.index', compact('oficios', 'anios'));
    }

    public function create()
    {
        $id = Oficios::select('num_oficio')
            ->where('activo', 1)
            ->latest()
            ->first();
        $oficio = $id->num_oficio + 1;
        $cuerpo = view('oficios.prestadores.cuerpo')->render();
        //$plantilla = view('oficios.prestadores.plantilla', compact("cuerpo"))->render();
        return view('oficios.prestadores.create', compact('cuerpo', 'oficio'));
    }
    public function show(Oficios $oficio)
    {
        $html = view('oficios.prestadores.plantilla', compact('oficio'));
        //return $html;
        $pdf = \PDF::loadHtml($html->render());
        $nombre = 'CUCSH_SA_CTA_' . $oficio->num_oficio . '_' . date('Y') . '.pdf';
        return $pdf->stream($nombre);
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
                'dirigido' => 'required'
            ],
            $this->messages,
        );

        $oficio = new Oficios();
        $oficio->activo = '1';
        foreach ($request->request as $key => $value) {
            if (!is_null($value) && strcmp('_token', $key) != 0 && strcmp('_method', $key) != 0 && strcmp('con_copia', $key) != 0) {
                $oficio->$key = $request->$key;
            }
        }

        $con_copia = Arr::exists($request, 'con_copia') ? implode('@', $request->con_copia) : '-';
        $oficio->con_copia = $con_copia;
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
        $con_copia = Arr::exists($request, 'con_copia') ? implode('@', $request->con_copia) : '-';
        $oficio->con_copia = $con_copia;
        $oficio->update();
        $anio = date('Y');
        return redirect()->route('oficios.inicio', $anio);
    }

    public function general()
    {
        $id = Oficios::select('num_oficio')
            ->where('activo', 1)
            ->latest()
            ->first();

        $oficio = $id->num_oficio + 1;
        return view('oficios.oficios.create', compact('oficio'));
    }
}

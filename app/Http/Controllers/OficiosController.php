<?php

namespace App\Http\Controllers;

use App\Models\Oficios;
use compra;
use Dompdf\Cpdf;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OficiosController extends Controller
{
    public $messages = [
        'dirigido.required' => 'Favor de ingresar a quien va dirigido',
        'num_oficio.required' => 'Favor de ingresar el número de oficio',
        'num_oficio.unique' => 'El número de oficio ya esta registardo',
        'dirigido.starts_with' => 'Favor de incluir el titulo académico de a quien va dirigido',
        'atencion.required' => 'Favor de ingresar a quien va con atención',
        'atencion.starts_with' => 'Favor de incluir el titulo académico de a quien va dirigido',
    ];

    public function index()
    {
        $oficios = Oficios::where('activo', 1)->get();
        return view('oficios.index', compact('oficios'));
    }

    public function create()
    {
        $id =
            Oficios::select('num_oficio')->where('activo', 1)
                ->latest()
                ->first();
        $oficio = $id->num_oficio + 1;
        $cuerpo = view('oficios.prestadores.cuerpo')->render();
        //$plantilla = view('oficios.prestadores.plantilla', compact("cuerpo"))->render();
        return view('oficios.prestadores.create', compact('cuerpo','oficio'));
    }
    public function show(Oficios $oficio)
    {
        $html = view('oficios.prestadores.plantilla', compact('oficio'));
        $pdf = \PDF::loadHtml($html->render());
        return $pdf->stream('formatoProyecto.pdf');
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
                'num_oficio' => 'required|unique:oficios,num_oficio',
                'dirigido' => 'required|starts_with:Lic.,Mtro.,Dr.,Mtra.,Dra.',
            ],
            $this->messages,
        );

        $oficio = new Oficios();
        $oficio->activo = '1';
        foreach ($request->request as $key => $value) {
            if (!is_null($value) && strcmp('_token', $key) != 0 && strcmp('_method', $key) != 0) {
                $oficio->$key = $request->$key;
            }
        }
        $oficio->save();
        return redirect()->route('oficios.index');
    }

    public function update(Request $request, Oficios $oficio)
    {
        $this->validate(
            $request,
            [
                'num_oficio' => 'required|unique:oficios,num_oficio,' . $oficio->id,
                'dirigido' => 'required|starts_with:Lic.,Mtro.,Dr.,Mtra.,Dra.',
            ],
            $this->messages,
        );

        foreach ($request->request as $key => $value) {
            if (!is_null($value) && strcmp('_token', $key) != 0 && strcmp('_method', $key) != 0) {
                $oficio->$key = $request->$key;
            }
        }
        $oficio->update();
        return redirect()->route('oficios.index');
    }

    public function general()
    {
        return view('oficios.oficios.create');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Oficios;
use compra;
use Dompdf\Cpdf;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OficiosController extends Controller
{
    public $messages  = [
        'dirigido.required' => 'Favor de ingresar a quien va dirigido',
        'num_oficio.required' => 'Favor de ingresar el número de oficio',
        'num_oficio.unique' => 'El número de oficio ya esta registardo',
        'dirigido.starts_with' => 'Favor de incluir el titulo académico de a quien va dirigido',
        'atencion.required' => 'Favor de ingresar a quien va con atención',
        'atencion.starts_with' => 'Favor de incluir el titulo académico de a quien va dirigido',
        'nombre.required' => 'Favor de ingresar tú nombre',
        'carrera.required' => 'Favor de ingresar tú carrera',
        'codigo.required' => 'Favor de ingresar tú código',
        'tipo_prestacion.required' => 'Ingresa el tipo de prestación que brindaste',
        'oficio.required' => 'Favor de ingresar el número de oficio (está en tú oficio de comición)',
        'programa.required' => 'Favor de ingresar el nombre del programa',
        'fecha_inicio.required' => 'Favor de ingresar la fecha de inicio',
        'fecha_fin.required' => 'Favor de ingresar la fecha de fin',
    ];

    public function index()
    {
        $oficios = Oficios::where('activo', 1)->get();
        return view('oficios.index', compact('oficios'));
    }

    public function create()
    {
        $cuerpo = view('oficios.prestadores.cuerpo')->render();
        //$plantilla = view('oficios.prestadores.plantilla', compact("cuerpo"))->render();
        return view('oficios.prestadores.create', compact('cuerpo'));
    }
    public function show(Oficios $oficio)
    {
        $html = view('oficios.prestadores.plantilla', compact('oficio'));
        $pdf = \PDF::loadHtml($html->render());
        return $pdf->stream('formatoProyecto.pdf');
    }
    public function edit(Oficios $oficio)
    {

        return view('oficios.prestadores.edit', compact('oficio'));
    }

    public function store(Request $request)
    {


        $this->validate($request, [
            'num_oficio' => 'required|unique:oficios,num_oficio',
            'dirigido' => 'required|starts_with:Lic.,Mtro.,Doc.',
            'atencion' => 'required|starts_with:Lic.,Mtro.,Doc.',
        ], $this->messages);

        $oficio = new Oficios();
        $oficio->activo = '1';
        foreach ($request->request as $key => $value) {
            if (!is_null($value) && strcmp('_token', $key) != 0) {
                $oficio->$key = $request->$key;
            }
        }
        $oficio->save();
        return redirect()->route('oficios.index');
    }


    public function update(Request $request, Oficios $oficio)
    {

        $this->validate($request, [
            'oficio' => 'required|unique:oficios,num_oficio',
            'dirigido' => 'required|starts_with:Lic.,Mtro.,Doc.',
            'atencion' => 'required|starts_with:Lic.,Mtro.,Doc.',
            'nombre' => 'required',
            'carrera' => 'required',
            'codigo' => 'required|size:9',
            'tipo_prestacion' => 'required',
            'oficio' => 'required',
            'programa' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
        ], $this->messages);

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

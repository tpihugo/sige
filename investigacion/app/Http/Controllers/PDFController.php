<?php

namespace App\Http\Controllers;

use App\Models\VsEquiposPorTicket;
use App\Models\VsPrestamo;
use App\Models\VsProyecto;
use App\Models\VsTicket;
use App\Models\Evaluacion;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function imprimirProyecto($proyecto_id){
     $proyecto = VsProyecto::where('id','=',$proyecto_id)->first();
        $pdf = \PDF::loadView('proyecto.formatoProyecto', compact('proyecto'));
        return $pdf->stream('formatoProyecto.pdf');

    }
    public function imprimirEvaluacion($proyecto_id){
        $proyecto = VsProyecto::where('id','=',$proyecto_id)->first();
        $evaluacion = Evaluacion::where('idProyecto','=',$proyecto_id)->first();
        $pdf = \PDF::loadView('evaluacion.formatoEvaluacion', compact('proyecto','evaluacion'));
        return $pdf->stream('formatoEvaluacion.pdf');

    }
}

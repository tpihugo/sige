<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Personal;
use App\Models\VsEquiposPorTicket;
use App\Models\VsMantenimiento;
use App\Models\VsPrestamo;
use App\Models\VsTicket;
use App\Models\Requisicion;
use Illuminate\Http\Request;

class PDFController extends Controller
{

    public function imprimirPrestamo($prestamo_id)
    {

        $prestamo = VsPrestamo::where('id', '=', $prestamo_id)->first();
        
        $temp = explode("<fin>,", $prestamo->lista_equipos);
        //dd($temp);
        $lista_final = collect();
        $equipo = collect();
        $cont = 0;
        foreach ($temp as $item => $llave) {
            $elements = explode("<accesorios>", $llave);
            $lista = explode("-", $elements[0]);
            $equipo['id'] = str_replace(" Id SIGE: ", "", $lista[0]);
            $equipo['idUDG'] = str_replace(" IdUdeG: ", "", $lista[2]);
            $equipo['tipo'] = $lista[1];
            $equipo['marca'] = str_replace(" Marca: ", "", $lista[3]);
            $equipo['modelo'] = str_replace(" Modelo: ", "", $lista[4]);
            $equipo['n_s'] = str_replace(" N/S: ", "", $lista[5]);

            //echo $elements[1];
            //var_dump(str_contains('<fin>', $elements[1]));
            if(str_contains('<fin>', $elements[1])){
                str_replace("<fin>",'', $elements[1]);
            }
            $lista_final[$cont] = ["equipo" => $equipo, 'accesorios' => $elements[1]];
            $cont = $cont + 1;
            //$lista_final[$cont] = [$elements[0],$elements[1]];
        }
        //dd($lista_final);
        $lista_final = collect($lista_final);

        $pdf = \PDF::loadView('prestamo.formatoPrestamo', compact('prestamo', 'lista_final'));
        return $pdf->stream('formatoPrestamo.pdf');
    }



    public function imprimirRecibo($ticket_id)
    {
        $ticket = VsTicket::where('id', '=', $ticket_id)->first();
        $equipoPorTickets = VsEquiposPorTicket::where('ticket_id', '=', $ticket_id)->get();
        $pdf = \PDF::loadView('ticket.formatoEquipoRecibido', compact('ticket', 'equipoPorTickets'));

        return $pdf->stream('formatoRecibo.pdf');
    }
    public function imprimirpersonal($id)
    {
        $personal = Personal::find($id);
        $pdf = \PDF::loadView('personal.formatopersonal', compact('personal'));

        return $pdf->stream('formatopersonal.pdf');
    }
    public function imprimirrequisicion($id)
    {
        $requisicion = Requisicion::find($id);
        $articulos = Articulo::where('requisicion_id', $requisicion->id)->get();
        $pdf = \PDF::loadView('requisiciones.formatorequisicion', compact('requisicion', 'articulos'));

        return $pdf->stream('formatorequisicion.pdf');
    }
}

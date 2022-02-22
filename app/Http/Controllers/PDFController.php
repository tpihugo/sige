<?php

namespace App\Http\Controllers;

use App\Models\VsEquiposPorTicket;
use App\Models\VsMantenimiento;
use App\Models\VsPrestamo;
use App\Models\VsTicket;
use Illuminate\Http\Request;

class PDFController extends Controller
{

    public function imprimirPrestamo($prestamo_id){
     $prestamo = VsPrestamo::where('id','=',$prestamo_id)->first();
        $pdf = \PDF::loadView('prestamo.formatoPrestamo', compact('prestamo'));
        return $pdf->stream('formatoPrestamo.pdf');

    }
    public function imprimirRecibo($ticket_id){
        $ticket = VsTicket::where('id','=',$ticket_id)->first();
        $equipoPorTickets = VsEquiposPorTicket::where('ticket_id','=', $ticket_id)->get();
        $pdf = \PDF::loadView('ticket.formatoEquipoRecibido', compact('ticket', 'equipoPorTickets'));

        return $pdf->stream('formatoRecibo.pdf');

    }
    public function imprimirMantenimiento($id){
        $mantenimiento = VsMantenimiento::where('id','=',$id)->first();
        $mantenimiento = VsMantenimiento::where('id','=', $id)->get();
        $pdf = \PDF::loadView('mantenimiento.formatoMantenimiento', compact('mantenimiento'));

        return $pdf->stream('formatoMantenimiento.pdf');

    }
}

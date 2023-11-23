<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VsTicket;
use Illuminate\Support\Carbon;
use App\Models\VsPrestamo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ticketsBelenes = VsTicket::where('activo', '=', 1)
            ->where('estatus', 'Abierto')
            ->where('sede', 'Belenes')
            ->count();

        $ticketsNormal = VsTicket::where('activo', '=', 1)
            ->where('estatus', '=', 'Abierto')
            ->where('sede', '=', 'La Normal')
            ->where('categoria', '<>', 'Reporte de aula')
            ->count();

        $vsprestamos = VsPrestamo::where('activo', '=', 1)
            ->where('estado', 'En préstamo')
            ->get();

        $prestamos_contador = VsPrestamo::where('activo', '=', 1)
            ->where('estado', 'En préstamo')
            ->count();

        $prestamos_expirados = $this->Notificacion_prestamos($vsprestamos);

        return view('home')
            ->with('ticketsNormal', $ticketsNormal)
            ->with('ticketsBelenes', $ticketsBelenes)
            ->with('notificacion', $prestamos_expirados)
            ->with('prestamos', $prestamos_contador);
    }

    public function Notificacion_prestamos($vsprestamos)
    {
        $count = 0;
        foreach ($vsprestamos as $key => $value) {
            $fechaInicio = $value->fecha_inicio;
            $fechaActualizacion = $value->fecha_actualizacion;
            $fechaActualizacion2 = \Carbon\Carbon::parse($fechaActualizacion)->format('Y/m/d');

            $fechaActual_prestamo = Carbon::now()
                ->parse()
                ->format('Y/m/d');

            if ($fechaInicio == $fechaActualizacion2) {
                $fechaProxima = \Carbon\Carbon::parse($fechaInicio)
                    ->addMonths(6)
                    ->format('Y/m/d');
            } else {
                if ($fechaActualizacion2 > $fechaInicio) {
                    $fechaProxima = \Carbon\Carbon::parse($fechaActualizacion2)
                        ->addMonths(6)
                        ->format('Y/m/d');
                }
            }

            if ($fechaActual_prestamo > $fechaProxima) {
                $count++;
            }
        }
        return $count;
    }
}

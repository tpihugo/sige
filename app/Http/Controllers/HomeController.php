<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VsTicket;
use Illuminate\Support\Carbon;
use App\Models\VsPrestamo;
use Illuminate\Support\Facades\Auth;
use App\Models\Modulos;
use DragonCode\Support\Facades\Helpers\Arr as HelpersArr;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

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
        $ticketsBelenes = VsTicket::where('status', '=', 1)
            ->where('sede', 'Belenes')
            ->count();

        $ticketsNormal = VsTicket::where('status', '=', 1)
            ->where('sede', '=', 'La Normal')
            ->count();

        $vsprestamos = VsPrestamo::where('activo', '=', 1)
            ->where('estado', 'En préstamo')
            ->get();

        $prestamos = VsPrestamo::where('activo', '=', 1)
            ->where('estado', 'En préstamo')
            ->count();

        $notificacion = $this->Notificacion_prestamos($vsprestamos);


        $user = Auth::user();
        $permissionNames = $user->getPermissionsViaRoles();

        $mapped = Arr::map($permissionNames->pluck('name')->toArray(), function (string $value, string $key) {
            return explode('#', $value)[0];
        });

       // $oficios_titulacion = DB::connection('mysql2')->table('oficios_titulacion')->where('enviado', 1)->where('estatus', null)->count();

        $nombres = array_values(array_unique($mapped));

        $modulos = Modulos::with('enlaces')->select('id', 'nombre', 'nombre_permiso', 'icono', 'color')->whereIn('nombre_permiso', $nombres)->orderBy('orden')->get();

        return view('home2', compact('modulos', 'ticketsNormal', 'ticketsBelenes', 'notificacion', 'prestamos'));

        return view('home')
            ->with('ticketsNormal', $ticketsNormal)
            ->with('ticketsBelenes', $ticketsBelenes)
            ->with('notificacion', $notificacion)
            ->with('prestamos', $prestamos);
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

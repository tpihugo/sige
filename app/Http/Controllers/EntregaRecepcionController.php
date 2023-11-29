<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\EntregaRecepcion;
use App\Models\VsEquipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JeroenNoten\LaravelAdminLte\View\Components\Widget\Alert;

class EntregaRecepcionController extends Controller
{
    //

    public function index()
    {
        $resguardantes = VsEquipo::select('id_resguardante', 'resguardante')
            ->where('tipo_sici', 'equipo')
            ->where('activo', 1)
            ->groupby('id_resguardante')
            ->distinct()
            ->get();

        $totales = VsEquipo::select('resguardante', DB::raw('count(*) as total'), 'id_resguardante')
            ->where('tipo_sici', '=', 'equipo')
            ->where('activo', 1)
            ->groupBy('id_resguardante')
            ->pluck('total', 'id_resguardante');

        foreach ($resguardantes as $key => $value) {
            $id = $value->id_resguardante;
            $value->total_equipos = $totales[$id];
        }
        return view('entregaRecepcion.index', compact('resguardantes'));
    }

    public function show($id_resguardante)
    {
        $resguardante = Empleado::where('codigo', $id_resguardante)->first();

        $equipos = VsEquipo::leftJoin('entrega_recepcions', 'vs_equipos.udg_id', '=', 'entrega_recepcions.id_equipo')
            ->select('vs_equipos.*', 'entrega_recepcions.ubicado', 'entrega_recepcions.id_usuario', 'entrega_recepcions.fecha')
            ->where('vs_equipos.activo', 1)
            ->where('vs_equipos.tipo_sici', 'equipo')
            ->where('vs_equipos.id_resguardante', $id_resguardante)
            ->get();
        $total = $this->total_resguardante($id_resguardante);
        return view('entregaRecepcion.equipos', compact('equipos', 'resguardante', 'total'));
    }

    public function guardar(Request $request)
    {
        date_default_timezone_set('America/Mexico_City');
        $id_usuario = Auth::user()->id;
        $registro = EntregaRecepcion::updateOrCreate(['id_equipo' => $request->id], ['id_usuario' => $id_usuario, 'fecha' => date('Y-m-d'), 'ubicado' => $request->ubicado]);
        if ($registro) {
            return $this->total_resguardante($request->resguardante);
        } else {
            return 'Error';
        }
    }
    public function total_resguardante($id_resguardante)
    {
        $equipos = VsEquipo::select('udg_id')
            ->where('activo', 1)
            ->where('id_resguardante', $id_resguardante)
            ->where('tipo_sici', 'equipo')
            ->get();

        $total = EntregaRecepcion::where('ubicado', 1)
            ->whereIn('id_equipo', $equipos)
            ->count();
        return [$equipos->count(), $total];
    }
}

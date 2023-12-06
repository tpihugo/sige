<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\EntregaRecepcion;
use App\Models\VsEquipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JeroenNoten\LaravelAdminLte\View\Components\Widget\Alert;

class EntregaRecepcionController extends Controller
{
    public function index()
    {
        $resguardantes = VsEquipo::select('id_resguardante', 'resguardante')
            ->where('tipo_sici', 'equipoCTA')
            ->where('activo', 1)
            ->groupby('id_resguardante')
            ->distinct()
            ->get();

        foreach ($resguardantes as $key => $value) {
            $id = $value->id_resguardante;
            $value->total_equipos = $this->total_resguardante($id);
        }
        return view('entregaRecepcion.index', compact('resguardantes'));
    }

    public function show($id_resguardante)
    {
        $resguardante = Empleado::where('codigo', $id_resguardante)->first();

        $equipos = VsEquipo::leftJoin('entrega_recepcions', 'vs_equipos.id', '=', 'entrega_recepcions.id_equipo')
            ->leftjoin('areas', 'vs_equipos.id_area', '=', 'areas.id')
            ->select('vs_equipos.*', 'entrega_recepcions.ubicado', 'entrega_recepcions.id_usuario', 'entrega_recepcions.fecha', 'areas.area as area_equipo')
            ->where('vs_equipos.activo', 1)
            ->where('vs_equipos.tipo_sici', 'equipoCTA')
            ->where('vs_equipos.id_resguardante', $id_resguardante)
            ->get();

        $total = $this->total_resguardante($id_resguardante);

        return view('entregaRecepcion.equipos', compact('equipos', 'resguardante', 'total'));
    }

    public function guardar(Request $request)
    {
        date_default_timezone_set('America/Mexico_City');
        $id_usuario = Auth::user()->id;
        $fecha = $request->ubicado == 0 ? 'Nunca ubicado' : date('Y-m-d');
        $registro = EntregaRecepcion::updateOrCreate(['id_equipo' => $request->id], ['id_usuario' => $id_usuario, 'fecha' => $fecha, 'ubicado' => $request->ubicado]);
        if ($registro) {
            if (isset($request->id_area)) {
                $resultados = $this->total_area($request->id_area);
            } else {
                $resultados = $this->total_resguardante($request->resguardante);
            }
            $datos = ['total' => $resultados[0], 'encontrados' => $resultados[1], 'fecha' => [$fecha, $request->id]];
            return $datos;
        } else {
            return 'Error, no se pudo guardar la ubicación del equipo';
        }
    }
    public function total_resguardante($id_resguardante)
    {
        $equipos = VsEquipo::select('id')
            ->where('activo', 1)
            ->where('id_resguardante', $id_resguardante)
            ->where('tipo_sici', 'equipoCTA')
            ->get();

        $total = EntregaRecepcion::where('ubicado', '=', 1)
            ->whereIn('id_equipo', $equipos)
            ->count();

        return [$equipos->count(), $total];
    }

    /*
Metodos por Área

*/
    public function por_area_index()
    {
        // Obtienes todos los equipos de CTA y sus respectivas áreas
        $equipos_totales = VsEquipo::leftjoin('areas', 'vs_equipos.id_area', '=', 'areas.id')
            ->select(DB::raw('count(*) as total'), 'vs_equipos.id_area', DB::raw('CONCAT(areas.sede, "-", areas.area) AS area_equipo'))
            ->where('vs_equipos.activo', 1)
            ->where('vs_equipos.tipo_sici', 'equipoCTA')
            ->orderBy('area_equipo', 'asc')
            ->groupBy('area_equipo');

        // Agrupas los equipos por el área en la que estan y sus cantidades
        $temp = $equipos_totales->pluck('total', 'area_equipo');

        // Obtitnes todos los equipos ya ubicados y agrupados por sus respectivas áreas
        $equipos_encontrados = VsEquipo::leftJoin('entrega_recepcions', 'vs_equipos.id', '=', 'entrega_recepcions.id_equipo')
            ->leftjoin('areas', 'vs_equipos.id_area', '=', 'areas.id')
            ->select(DB::raw('count(*) as total'), 'vs_equipos.udg_id', 'vs_equipos.id_area', 'entrega_recepcions.ubicado', 'entrega_recepcions.id_usuario', 'entrega_recepcions.fecha', DB::raw('CONCAT(areas.sede, "-", areas.area) AS area_equipo'))
            ->where('vs_equipos.activo', 1)
            ->where('vs_equipos.tipo_sici', 'equipoCTA')
            ->where('vs_equipos.tipo_sici', 'equipoCTA')
            ->where('entrega_recepcions.ubicado', '=', 1)
            ->groupBy('area_equipo')
            ->orderBy('area_equipo', 'asc')
            ->pluck('total', 'area_equipo')
            ->toArray();

        // Agrupas los equipos por el área en la que estan y el id de area que tiene cada una
        $areas = $equipos_totales->pluck('vs_equipos.id_area', 'area_equipo');

        // Unes las colleciones que tienen los id´s de área y sus respectivas cantidades totales de equipos
        $areas_temp = $areas->mergeRecursive($temp);

        $areas_temp = $areas_temp->mergeRecursive($equipos_encontrados);
        return view('entregaRecepcion.area.index', compact('areas_temp'));
    }

    public function por_area($id)
    {
        if (strcmp('Ninguno', $id) == 0) {
            $equipos_totales = VsEquipo::leftjoin('areas', 'vs_equipos.id_area', '=', 'areas.id')
                ->leftJoin('entrega_recepcions', 'vs_equipos.id', '=', 'entrega_recepcions.id_equipo')
                ->select('vs_equipos.id', 'vs_equipos.udg_id', 'vs_equipos.id_resguardante', 'vs_equipos.resguardante', 'vs_equipos.localizado_sici', 'vs_equipos.marca', 'vs_equipos.modelo', 'vs_equipos.numero_serie', 'vs_equipos.tipo_equipo')
                ->where('vs_equipos.activo', 1)
                ->where('vs_equipos.tipo_sici', 'equipoCTA')
                ->where('id_area', null)
                ->get();

            $area = collect(['area' => 'Sin área', 'id' => '0']);
        } else {
            $equipos_totales = VsEquipo::leftjoin('areas', 'vs_equipos.id_area', '=', 'areas.id')
                ->leftJoin('entrega_recepcions', 'vs_equipos.id', '=', 'entrega_recepcions.id_equipo')
                ->select('vs_equipos.id', 'vs_equipos.udg_id', 'vs_equipos.id_resguardante', 'vs_equipos.resguardante', 'vs_equipos.localizado_sici', 'vs_equipos.marca', 'vs_equipos.modelo', 'vs_equipos.numero_serie', 'vs_equipos.tipo_equipo', 'entrega_recepcions.ubicado', 'entrega_recepcions.id_usuario', 'entrega_recepcions.fecha')
                ->where('vs_equipos.activo', 1)
                ->where('vs_equipos.tipo_sici', 'equipoCTA')
                ->where('id_area', $id)
                ->get();
            $area = Area::select('id', 'area')
                ->where('id', $id)
                ->first()
                ->toArray();
        }

        $total = $this->total_area($id);

        return view('entregaRecepcion.area.equipos', compact('equipos_totales', 'area', 'total'));
    }

    public function total_area($id)
    {
        $equipos = VsEquipo::select('id')
            ->where('activo', 1)
            ->where('id_area', $id)
            ->where('tipo_sici', 'equipoCTA')
            ->get();

        $total = EntregaRecepcion::where('ubicado', '=', 1)
            ->whereIn('id_equipo', $equipos)
            ->count();

        return [$equipos->count(), $total];
    }
}

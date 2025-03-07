<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\Equipo;
use App\Models\Tecnico;
use App\Models\Ticket;
use App\Models\Solicitante;
use App\Models\Servicio;
use App\Models\ticket_historial;
use App\Models\VsEquiposPorTicket;
use App\Models\VsTicket;
use App\Models\VsTecnico;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\EquipoTicket;
use DateTime;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Detection\MobileDetect as MobileDetect;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{

    protected $indice_influencia = [
        ['Moderada','Moderada','Significativa'],
        ['Moderada','Moderada','Significativa'],
        ['Significativa','Significativa','Significativa'],
        ['Significativa','Significativa','Significativa'],
        ['Baja','Moderada','Moderada'],
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //este es el que tengo que modificar DZ-- inicia la modificacion 1
    public function index()
    {
        $id_tecnico = Tecnico::where('activo', 1)->where('user_id', Auth::user()->id)->first();
        $tecnicos = VsTecnico::where('activo', '=', 1)->orderBy('nombre')->get();
        

        //vista de admin
        if(!Auth::user()->hasRole('cta')){
            $vstickets = VsTicket::where('estatus', '=', 1)->get();
            $tickets = $this->cargarDT($vstickets);
            return view('ticket.index')->with('tickets', $tickets)->with('tecnicos', $tecnicos);
        }
        
        $vstickets = VsTicket::where('estatus', '=', 1)->where('tecnico_id', $id_tecnico->id)->get();
        if($vstickets->count()==0){
            $experiencia = VsTicket::select('servicio_id', DB::raw('count(*) as total'))
            ->where('estatus', '=', '0')
            ->where('tecnico_id', $id_tecnico->id)
            ->groupBy('servicio_id')
            ->orderBy('total','desc')
            ->get();
            
            if($experiencia->count()>0){
                $vstickets_temp = collect([]);
                foreach ($experiencia as $key => $value) {
                    $vstickets_temp[] = VsTicket::where('estatus', '=', 1)
                    ->where('servicio_id', $value->servicio_id)
                    ->where('tecnico_id','41')
                    ->orderBy('prioridad')
                    ->get();
                }
                $vstickets = $vstickets_temp->collapse();
            } else {
                $vstickets = VsTicket::where('estatus', '=', 1)
                ->where('tecnico_id','41')
                ->orderBy('prioridad')
                ->get();
            }
        } 

      //  with($vstickets)->where id tecnico 
        $tickets = $this->cargarDT($vstickets->take(2));
        



        return view('ticket.index', compact('id_tecnico'))->with('tickets', $tickets)->with('tecnicos', $tecnicos);
    }
    //este el que se modificó fin de la modificación 1
    public function cargarDT($consulta)
    {

        $tickets = [];
        $tecnico = Tecnico::where('activo', 1)->where('user_id', Auth::user()->id)->first();
        foreach ($consulta as $key => $value) {

            $actualizar =  route('tickets.edit', $value['id']);
            $recibo = route('recepcionEquipo',  $value['id']);
            $tomar = route('tomar-ticket', $value['id']);
            $cerrar = route('cerrar-ticket', $value['id']);
            $registro_historial = ticket_historial::where('id_ticket', $value['id'])->orderBy('created_at')->get();
            $historial = '';
            

            if (Auth::user()->id == 161 || Auth::user()->role  == 'admin') {
                $tomar = '<button type="button" onclick="tomar_ticket(' . $value['id'] . ')" class="btn btn-warning btn-sm m-1" data-toggle="modal" data-target="#tomar-ticket">
                <i class="far fa-hand-paper"></i>
              </button>
              ';
              $cerrar = '<button type="button" onclick="cerrar_ticket(' . $value['id'] . ')" class="btn btn-success btn-sm m-1" data-toggle="modal" data-target="#cerrar-ticket" title="Cerrar ticket">
                    <i class="far fa-check"></i>
                </button>';
            } elseif (isset($tecnico)) {
                if ($tecnico->id != $value['tecnico_id']) {
                    $tomar = '<a href="' . $tomar . '" class="btn btn-warning btn-sm" title="Tomar ticket">
                    <i class="far fa-hand-paper"></i>
               </a>';
                    $cerrar = '';
                } else {
                    $tomar = '';
                    $cerrar = '';
                }
                if ($tecnico->id == $value['tecnico_id']) {
                    $tomar = '<button type="button" onclick="soltar_ticket(' . $value['id'] . ')"  class="m-1 btn btn-sm" style="background-color: #3f6791; color:#fff;" data-toggle="modal" data-target="#soltar-ticket">
                    <i class="far fa-hand-paper"></i>
                  </button>';
                  $cerrar = '<button type="button" onclick="cerrar_ticket(' . $value['id'] . ')" class="btn btn-success btn-sm m-1" data-toggle="modal" data-target="#cerrar-ticket" title="Cerrar ticket">
                    <i class="far fa-check"></i>
                  </button>';
                }
            }
            if (count($registro_historial) > 0) {
                foreach ($registro_historial as $item) {
                    $tecnico_nombre = VsTecnico::where('user_id', $item->id_user)->first();
                    $item->nombre = $tecnico_nombre->nombre;
                }
                $historial = '<button type="button" onclick=' . "'" . 'historial(' . $registro_historial . ')' . "'" . ' class="m-1 btn btn-sm"style="background-color: #3f6791; color:#fff;"  data-toggle="modal" data-target="#historial-ticket">
                <i class="far fa-list-alt"></i>
                </button>';
            }
            $acciones = '
                <div class="btn-acciones">
                    <div class=" d-flex align-items-center justify-content-center">
                        <a href="' . $actualizar . '" class="btn btn-success btn-sm m-1 " title="Actualizar">
                            <i class="far fa-edit"></i>
                        </a>
			            <a href="' . $recibo . '" class="btn btn-primary btn-sm m-1 " title="Recibo de Equipo">
                            <i class="far fa-file"></i>
                        </a>'
                . $tomar . $cerrar . $historial .
                '
                    </div>
                </div>
                </div>
              </div>
            ';


            $area = $value['area'];
            if (str_contains($area, 'Belenes')) {
                $area = str_replace('- Belenes ', "", $area);
                $area = '<b>Belenes</b> - ' . $area;
            } else {
                $area = str_replace('- La Normal ', "", $area);
                $area = '<b>La Normal</b> - ' . $area;
            }
            $reporte=$value['nombre_servicio']." - ".$value['datos_reporte'];

            $tickets[$key] = array(

                $value['id'],
                $value['fecha_reporte'] = \Carbon\Carbon::parse($value->fecha_reporte)->format('d/m/Y H:i'),
                $area,
                $value['solicitante'],
                $value['tecnico'],
                $reporte,
                $acciones,
            );
        }

        return $tickets;
    }
    public function revisionTickets()
    {
        $vstickets = VsTicket::where('estatus', '=', 1)->get();
        $tecnicos = VsTecnico::where('activo', '=', 1)->get();
        $tickets = $this->cargarDT($vstickets);
        return view('ticket.revisionTickets')->with('tickets', $tickets)->with('tecnicos', $tecnicos);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $areas = Area::where('activo', 1)->get();
        //$tecnicos = Tecnico::where('activo', '=', 1)->orderBy('nombre')->get();
        $solicitantes = Solicitante::orderBy('nombre')->get();
        $servicios = Servicio::orderBy('nombre')->get();
        return view('ticket.create') ->with('areas', $areas)->with('servicios', $servicios)->with('solicitantes', $solicitantes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'area_id' => 'required',
            'solicitante_id' => 'required',
            'servicio_id' => 'required',
        ]);




        $solicitante= Solicitante::where('id',$request->solicitante_id)->first();
        $area= Area::where('id',$request->area_id)->first();
        $prioridades=DB::table("prioridades_incidente")->get();

        $porcentaje_afectados=($area->cantidad_usuarios*100)/14298;
        if($porcentaje_afectados<=10){
            $porcentaje=0;
        } elseif($porcentaje_afectados<=30){
            $porcentaje=1;
        } else {
            $porcentaje=2;
        }
        $influencia=$this->indice_influencia[$solicitante->rol-1][$porcentaje];
        $servicio= Servicio::where('id',$request->servicio_id)->first();
        $prioridad=DB::table("prioridades_incidente")
        ->select('indice')
        ->where('urgencia',$servicio->urgencia)
        ->where('influencia',$influencia)->first();






        $ticket = new Ticket();
        $ticket->area_id = $request->input('area_id');
        $ticket->solicitante_id = $request->input('solicitante_id');
        $ticket->servicio_id = $request->input('servicio_id');
        $ticket->datos_reporte = $request->input('datos_reporte');
        $ticket->prioridad = $prioridad->indice;
        $ticket->save();
        //
        $log = new Log();
        $log->tabla = 'tickets';
        $log->movimiento = "área id: " . $ticket->area_id . "Solicitante: " . $ticket->solicitante_id.  "Datos de reporte: " . $ticket->datos_reporte;
        $log->usuario_id = Auth::user()->id;
        $log->acciones = 'Insertar';
        $log->save();
        $ticket->save();
        //
        return redirect('tickets')->with(array(
            'message' => 'El Ticket se guardo Correctamente'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $areas = Area::all();
        $solicitantes = Solicitante::orderBy('nombre')->get();
        $servicios = Servicio::orderBy('nombre')->get();
        $ticket = VsTicket::find($id);
        $tecnicos = VsTecnico::where('activo', '=', 1)->orderBy('nombre')->get();
        return view('ticket.edit')->with('ticket', $ticket)->with('areas', $areas)->with('tecnicos', $tecnicos)->with('solicitantes', $solicitantes)->with('servicios', $servicios);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'area_id' => 'required',
            'solicitante_id' => 'required',
            'tecnico_id' => 'required',
            'servicio_id' => 'required',
            'estatus' => 'required',
        ]);

        $solicitante= Solicitante::where('id',$request->solicitante_id)->first();
        $area= Area::where('id',$request->area_id)->first();
        $prioridades=DB::table("prioridades_incidente")->get();

        $porcentaje_afectados=($area->cantidad_usuarios*100)/14298;
        if($porcentaje_afectados<=10){
            $porcentaje=0;
        } elseif($porcentaje_afectados<=30){
            $porcentaje=1;
        } else {
            $porcentaje=2;
        }
        $influencia=$this->indice_influencia[$solicitante->rol-1][$porcentaje];
    
        $servicio= Servicio::where('id',$request->servicio_id)->first();
        //return $servicio;
        $prioridad=DB::table("prioridades_incidente")
        ->select('indice')
        ->where('urgencia',$servicio->urgencia)
        ->where('influencia',$influencia)->first();


        $ticket = Ticket::find($id);
        $ticket->area_id = $request->input('area_id');
        $ticket->solicitante_id = $request->input('solicitante_id');
        $ticket->tecnico_id = $request->input('tecnico_id');
        $ticket->datos_reporte = $request->input('datos_reporte');
        $ticket->prioridad = $prioridad->indice;
        $ticket->estatus = $request->input('estatus');
        $ticket->update();
        //
        $log = new Log();
        $log->tabla = "tickets";
        $mov = "";
        $mov = $mov . " area_id: " . $ticket->area_id . " solicitante_id: " . $ticket->solicitante_id;
        $mov = $mov . " tecnico_id: " . $ticket->tecnico_id;
        /*if (!is_null($ticket->fecha_termino) && isset($ticket->fecha_termino)) {
            $mov = $mov . " estatus: Cerrado";
        } else {
            $mov = $mov . " estatus:" . $ticket->estatus;
        }*/
        $mov = $mov . " datos_reporte: " . $ticket->datos_reporte;
        $log->movimiento = $mov;
        $log->usuario_id = Auth::user()->id;
        $log->acciones = "Edicion";
        $log->save();
        //
        return redirect('tickets')->with(array(
            'message' => 'El Ticket se guardo Correctamente'
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function filtroTickets(Request $request)
    {
        $tecnicos = VsTecnico::where('activo', '=', 1)->get();
        $tecnico = $request->input('tecnico_id');
        $estatus = $request->input('estatus');
        $sede = $request->sede;
        //return $sede;
        $tecnicoElegido = Tecnico::find($tecnico);
        

        if ((isset($tecnico) && !is_null($tecnico)) && (isset($estatus) && !is_null($estatus))) {
            if (isset($sede)) {
                $vstickets = VsTicket::where('tecnico_id', '=', $tecnico)
                    ->Where('estatus', '=', $estatus)
                    ->where('sede', $sede)
                    ->get();
            } else {
                $vstickets = VsTicket::where('tecnico_id', '=', $tecnico)
                    ->Where('estatus', '=', $estatus)
                    ->get();
            }
        } elseif ((isset($tecnico) && !is_null($tecnico)) && (!isset($estatus) && is_null($estatus))) {
            if (isset($sede)) {
                $vstickets = VsTicket::where('tecnico_id', '=', $tecnico)
                    ->where('sede', $sede)
                    ->get();
            } else {
                $vstickets = VsTicket::where('tecnico_id', '=', $tecnico)
                    ->get();
            }
        } elseif ((!isset($tecnico) && is_null($tecnico)) && (isset($estatus) && !is_null($estatus))) {
            if (isset($sede)) {
                $vstickets = VsTicket::where('estatus', '=', $estatus)
                    ->where('sede', $sede)
                    ->get();
            } else {

                $vstickets = VsTicket::where('estatus', '=', $estatus)
                    ->get();
            }
        } else {
            if (isset($sede)) {
                $vstickets = VsTicket::where('sede', $sede)->get();
            } else {
                $vstickets = VsTicket::get();
            }
        }
        $tickets = $this->cargarDT($vstickets);

        $id_tecnico = Tecnico::where('activo', 1)->where('user_id', Auth::user()->id)->first();
        return view('ticket.index', compact('id_tecnico'))->with('tickets', $tickets)->with('tecnicos', $tecnicos)
            ->with('tecnicoElegido', $tecnicoElegido)->with('estatus', $estatus);
    }

    public function recepcionEquipo($ticket_id)
    {
        $ticket = VsTicket::find($ticket_id);
        $equipoPorTickets = VsEquiposPorTicket::where('ticket_id', '=', $ticket_id)->get();
        //$cuentaEquipoPorTickets = VsEquiposPorTicket::where('ticket_id', '=', $ticket_id)->count();

        return view('ticket.agregarEquiposTicket')->with('ticket', $ticket)->with('ticket_id', $ticket_id)->with('equipoPorTickets', $equipoPorTickets);
    }

    public function registrarEquipoTicket($equipo_id, $ticket_id)
    {
        $equipoTicket = new EquipoTicket();
        $equipoTicket->ticket_id = $ticket_id;
        $equipoTicket->equipo_id = $equipo_id;
        $equipoTicket->save();
        return redirect('recepcionEquipo/' . $ticket_id)->with(array(
            'message' => 'El Equipo se agregó Correctamente al Ticket'
        ));
    }
    public function eliminarEquipoTicket($equipo_id, $ticket_id)
    {
        EquipoTicket::where('ticket_id', '=', $ticket_id)->where('equipo_id', '=', $equipo_id)->delete();
        return redirect('recepcionEquipo/' . $ticket_id)->with(array(
            'message' => 'El Equipo se agregó Correctamente al Ticket'
        ));
    }
    public function delete_ticket($ticket_id)
    {
        $ticket = Ticket::find($ticket_id);
        if ($ticket) {
            $ticket->activo = 0;
            $ticket->update();
            //
            $log = new Log();
            $log->tabla = "tickets";
            $mov = "";
            $mov = $mov . " area_id:" . $ticket->area_id . " solicitante:" . $ticket->solicitante . " contacto" . $ticket->contacto;
            $mov = $mov . " tecnico_id:" . $ticket->tecnico_id . " categoria:" . $ticket->categoria . " prioridad" . $ticket->prioridad;
            if (!is_null($ticket->fecha_termino) && isset($ticket->fecha_termino)) {
                $mov = $mov . " estatus: Cerrado";
            } else {
                $mov = $mov . " estatus:" . $ticket->estatus;
            }
            $mov = $mov . " datos_reporte:" . $ticket->datos_reporte . " fecha_reporte" . $ticket->fecha_reporte;
            $mov = $mov . " fecha_inicio:" . $ticket->fecha_inicio . " datos_reporte:" . $ticket->datos_reporte . " fecha_termino" . $ticket->fecha_termino;
            $mov = $mov . " problema:" . $ticket->problema . " solucion:" . $ticket->solucion . ".";
            $log->movimiento = $mov;
            $log->usuario_id = Auth::user()->id;
            $log->acciones = "Borrrado";
            $log->save();
            //
            return redirect()->route('tickets.index')->with(array(
                "message" => "El ticket se ha eliminado correctamente"
            ));
        } else {
            return redirect()->route('home')->with(array(
                "message" => "El ticket que trata de eliminar no existe"
            ));
        }
    }
    public function agregarComentario(Request $request)
    {
        $ticket_equipo = EquipoTicket::where('ticket_id', '=', $request->input('ticket_id'))->where('equipo_id', '=', $request->input('equipo_id'))->first();
        $ticket_equipo->comentarios = $request->input('comentarios');
        $ticket_equipo->update();
        return redirect('recepcionEquipo/' . $request->input('ticket_id'))->with(array(
            'message' => 'El Equipo se agregó Correctamente al Ticket'
        ));
    }
    public function historial($id)
    {
        $tickets = VsTicket::where('activo', '=', 1)->where('area_id', '=', $id)->get();
        $tecnicos = Tecnico::where('activo', '=', 1)->get();
        $tickets = $this->cargarDT($tickets);
        return view('ticket.index')->with('tickets', $tickets)->with('tecnicos', $tecnicos);
    }
    public function tomar_ticket($id, Request $request)
    {


        if (isset($request->tecnico)) {
            $tecnico =  Tecnico::select('id')->where('id', $request->tecnico)->first();
        } else {
            //return Auth::user()->id;
            $tecnico =  Tecnico::select('id')->where('activo', '=', 1)->where('user_id', Auth::user()->id)->first();
        }
        //return $tecnico;
        $total = VsTicket::where('tecnico_id', '=', $tecnico->id)
        ->where('estatus',1)
        ->get();

        //return count($total);
        if (count($total) < 3 || $tecnico->id == 161) {
            $ticket = Ticket::find($id);
            $ticket->tecnico_id = $tecnico->id;
            $ticket->save();
            return redirect()->route('tickets.index')->with(array(
                'message' => 'Se asigno correctamente el ticket'
            ));
        } else {
            return redirect()->route('tickets.index')->with(array(
                "error" => "No puedes tomar tantos tickets, antes de tomar más completa los que ya tienes asignados."
            ));
        }
    }
    public function soltar_ticket($id, Request $request)
    {
        $validateData = $this->validate($request, [
            'detalle' => 'required',
            'motivo' => 'required',
        ]);
        date_default_timezone_set('America/Mexico_City');
        $historial = new ticket_historial();
        $historial->id_user = Auth::user()->id;
        $historial->id_ticket = $id;
        $historial->motivo = $request->motivo;
        $historial->detalles = $request->detalle;
        $historial->save();
        $ticket = Ticket::find($id);
        $ticket->tecnico_id  = 41;
        $ticket->save();
        return redirect()->route('tickets.index')->with(array(
            'message' => 'Se libero el ticket correctamente'
        ));
    }
    public function cerrar_ticket($id, Request $request)
    {
        $validateData = $this->validate($request, [
            'solucion' => 'required',
        ]);
        date_default_timezone_set('America/Mexico_City');
        $historial = new ticket_historial();
        $historial->id_user = Auth::user()->id;
        $historial->id_ticket = $id;
        $historial->motivo = "Solución";
        $historial->detalles = $request->solucion;
        $historial->save();
        $ticket = Ticket::find($id);
        $ticket->estatus  = '0';
        $ticket->save();
        return redirect()->route('tickets.index')->with(array(
            'message' => 'Se cerro el ticket correctamente'
        ));
    }

    public function ticket_reporte()
    {
        $tickets = VsTicket::select('fecha_reporte', 'id', 'tipo_espacio', 'area')->where('fecha_reporte', '!=', null)->where('activo', 1)->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->fecha_reporte)->format('Y-W');
            });

        $totales = collect([]);
        $maximo = 0;
        foreach ($tickets as $key => $value) {
            $year = intval(explode('-', $key)[0]);
            $week = intval(explode('-', $key)[1]);
            $dto = new DateTime();
            $aulas = $value->groupBy('tipo_espacio');
            $aula = 0;
            if (isset($aulas["Aula"]) || isset($aulas["Laboratorio"])) {
                $aula = (isset($aulas["Aula"])) ? count($aulas["Aula"]) : 0;
                $laboratorio = (isset($aulas["Laboratorio"])) ? count($aulas["Laboratorio"]) : 0;
                $aula = $aula + $laboratorio;
                if ($aula > $maximo) {
                    $maximo = $aula;
                }
            }
            $temp = number_format(($aula / $value->count()) * 100, 1);
            $array = [
                "Inicio" => $dto->setISODate($year, $week)->format('Y-m-d'),
                "Fin" => $dto->modify('+6 days')->format('Y-m-d'),
                "General" => $value->count(),
                "Aulas" => $aula,
                'Porcentaje' => [$temp, 100 - $temp],
            ];
            $totales->put($key, $array);
        }
        return  view('ticket.reportes.index', compact('totales', 'maximo'));
    }
    public function reporte_area($fecha)
    {

        $fechas = explode(",", $fecha);
        $inicio = $fechas[0];
        $fin = $fechas[1];
        $ticket = VsTicket::select('fecha_reporte', 'area')->where('fecha_reporte', '>=', $inicio)->where('fecha_reporte', '<=', $fin)->get();
        foreach ($ticket as $key => $value) {
            $value->division = explode("-", $value->area)[0];
            if ($value->area != null) {
                $value->departamento = explode("-", $value->area)[1];
            } else {
                $value->division = "Sin Área ";
                $value->departamento = "Área Desconocida";
            }
        }
        $ticket = $ticket->groupBy('division');
        //return $ticket;
        return view('ticket.reportes.tabla', compact('ticket'))->render();
    }
}

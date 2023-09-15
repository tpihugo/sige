<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\VsDatosIp;
use App\Models\Equipo;
use App\Models\Ip;
use App\Models\Subred;
use App\Models\VsIps;
use App\Models\VsEquipo;
use App\Models\Vs_Ips_Subredes;
use Illuminate\Http\Request;
use Stringable;
use Illuminate\Validation\Rule;

class IpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Carga la página de inicio del objeto
        $ip = Ip::join('vs_equipos', 'vs_equipos.id', '=', 'ips.id_equipo')
            ->join('empleados', 'empleados.id', '=', 'vs_equipos.id_resguardante')
            ->join('subredes', 'ips.Subred_id', '=', 'subredes.id')
            ->select('subredes.*', 'vs_equipos.*', 'ips.*', 'empleados.nombre')
            ->where('ips.activo', '=', 1)
            ->get();

        $listaip = $this->cargarDT($ip);

        $subredes = Subred::where('activo', '=', 1)->get();
        $vs_equipos = VsEquipo::all();
        $ips = $this->cargarDTall($ip);
        return view('ips.index')
            ->with('ips', $ip)
            ->with('ips', $ips)
            ->with('listaip', $listaip)
            ->with('subredes', $subredes)
            ->with('vs_equipos', $vs_equipos);
    }
    /**
     * Show the form for creating a new resource
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ips = Ip::all();
        $subred = Subred::where('activo', '=', 1)->get();
        //sentencia utilizada para visualizar los datos del equipo usando la tabla empleados y la vista vs_equipo.
        $vs_equipos = VsEquipo::select(
            'vs_equipos.id',
            'vs_equipos.id_resguardante',
            Empleado::raw('COUNT(empleados.id) as empleados_count'),
            'vs_equipos.udg_id',
            'vs_equipos.numero_serie',
            'vs_equipos.mac',
            'vs_equipos.tipo_equipo',
            'vs_equipos.area',
            'empleados.nombre', // Agregamos el campo nombre de la tabla empleados
        )
            ->leftJoin('empleados', 'empleados.id', '=', 'vs_equipos.id_resguardante')
            ->whereIn('vs_equipos.tipo_equipo', ['Access Point', 'Cámara', 'Cámara de Red', 'CPU', 'Impresoras', 'Multifuncional', 'Laptop', 'Router', 'Servidor', 'Switch', 'Teléfono'])
            ->groupBy('vs_equipos.id')
            ->toSql();
        return $vs_equipos;
        return view('ips.create')
            ->with('ips', $ips)
            ->with('subredes', $subred)
            ->with('vs_equipos', $vs_equipos);
    }

    public function cargarDT($consulta)
    {
        $ips = [];
    }
    public function cargarDTall($consulta)
    {
        $ipsdisp = [];

        foreach ($consulta as $key => $value) {
            $ruta = 'eliminar' . $value['id'];
            $actualizar = route('ips.edit', $value['id']);
            $detalle = route('ips.show', $value['id']);
            $eliminar = route('delete_ip', $value['id']);
            $acciones =
                '
                <div class="btn-acciones">
                        <div class="btn-circle">
                            <a href="' .
                $detalle .
                '"  class="btn btn-primary" title="Ver""><i class="far fa-eye"></i></a>
                            <a href="#' .
                $ruta .
                '" role="button" class="btn btn-danger" data-toggle="modal" title="Eliminar"><i class="far fa-trash-alt"></i></a>
                        </div>
                </div>
                <div class="modal fade" id="' .
                $ruta .
                '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar esta Ip?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                      <p class="text-primary">
                            <small>
                                ID: ' .
                $value['id'] .
                '.<br>
                                IP: ' .
                $value['ip'] .
                '.<br>
                                Subred: ' .
                $value['Subred_id'] .
                '.<br>
                                Equipo: ' .
                $value['id_equipo'] .
                '.
                            </small>
                      </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <a href="' .
                $eliminar .
                '" type="button" class="btn btn-danger">Eliminar</a>
                        </div>
                  </div>
            </div>
            </div>
            ';
            $ipsdisp[$key] = ['<center>' . $value['ip'] . '</center>', '<center>' . $value['ocupada'] . '</center>', '<b>Número de VLAN:</b> ' . $value['vlan'] . '<br><b>Número de Serie:</b> ' . $value['numero_serie'] . '.<br><b>MAC:</b> ' . $value['mac'] . '.<br><b>Responsable:</b> ' . $value['nombre'] . '.', '<center>' . $acciones . '</center>'];
        }
        return $ipsdisp;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //guarda un nuevo registro a partir de la vista create.
        $validateData = $this->validate(
            $request,
            [
                //validación del formulario
                'id_equipo' => 'required |unique:ips,id_equipo',
            ],
            [
                'unique' => 'El Equipo con ese :attribute ya fue asignado.',
                'required' => 'El campo :attribute es requerido',
            ],
        );

        $equipos = Ip::join('vs_equipos', 'vs_equipos.id', '=', 'ips.id_equipo')
            ->select('ips.id_equipo')
            ->where('vs_equipos.id', '=', 'ips.id_equipo')
            ->get();
        //validación para no permitir que un equipo se ha asignado dos veces a una IP, tomando como excepción el valor "0" que representa sin
        for ($i = 0; ($i = $equipos); $i++) {
            $ip = new Ip();
        }
        if ($request->id_equipo == 0) {
            $ip->ocupada = 'no';
            $ip->save();
            return redirect()
                ->route('ips.index')
                ->with(['message' => 'Ip creada con éxito.']);
        }
        if (($ip->id_equipo = $request->id_equipo) != $equipos[$i]->id) {
            $ip->ocupada = 'si';
            $ip->save();
            return redirect()
                ->route('ips.index')
                ->with(['message' => 'Ip creada con éxito.']);
        } else {
            return redirect()
                ->route('ips.index')
                ->with(['error' => 'El equipo ya fue asignado a una IP.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ip  $ip
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ip = Ip::find($id);
        $i = Ip::find($id, ['id']);

        $subred = Ip::join('subredes', 'ips.Subred_id', '=', 'subredes.id')
            ->select('subredes.*')
            ->where('ips.id', '=', $id)
            ->first();
        
        //Sentencia para visualizar los datos uniendo las tablas ips, empleados, y la vita vs_equipo, utilizado en la vista create y edit
        $edit = Ip::join('vs_equipos', 'vs_equipos.id', '=', 'ips.id_equipo')
            ->leftJoin('empleados', 'empleados.id', '=', 'vs_equipos.id_resguardante')
            ->select(
                'vs_equipos.id',
                'ips.id',
                'vs_equipos.id_resguardante',
                Empleado::raw('IFNULL(empleados.nombre, "Sin nombre disponible") AS nombre'), // Agregamos la condición para mostrar "sin nombre" si el nombre del empleado es nulo
                'vs_equipos.udg_id',
                'vs_equipos.numero_serie',
                'vs_equipos.mac',
                'ips.id_equipo',
                'vs_equipos.tipo_equipo',
                'vs_equipos.area',
            )
            ->where('ips.id', '=', $id)
            ->first();

        //Sentencia para visualizar los datos uniendo las tablas ips, empleados, y la vita vs_equipo, utilizado en la vista create
        /* $vs_equipos = VsEquipo::join('empleados', 'empleados.id', '=', 'vs_equipos.id_resguardante')
            ->select('vs_equipos.id', 'vs_equipos.id_resguardante', 'empleados.nombre', 'vs_equipos.udg_id', 'vs_equipos.numero_serie', 'vs_equipos.mac', 'vs_equipos.tipo_equipo', 'vs_equipos.area')
            ->where('vs_equipos.activo', '=', 1)
            ->get();
*/
        $subredes = Subred::where('activo', '=', 1)->get();
        //Validación para visualizar si la IP está en uso por un equipo, muestre la vista show y  si no tiene equipo asignado, muestre show1.
        if ($ip->id_equipo == 0) {
            return view('ips.show1')
                ->with('ip', $ip)
                ->with('i', $i)
                ->with('edit', $edit)
                ->with('subred', $subred)
                ->with('subredes', $subredes);
        } else {
            return view('ips.show')
                ->with('i', $i)
                ->with('ip', $ip)
                ->with('edit', $edit)
                ->with('subred', $subred)
                ->with('subredes', $subredes);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ip  $ip
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Editar IP'S Guardadas
        $ip = Ip::find($id);
        $subred = Ip::join('subredes', 'ips.Subred_id', '=', 'subredes.id')
            ->select('subredes.*')
            ->where('ips.id', '=', $id)
            ->first();
        //Sentencia para visualizar los datos uniendo las tablas ips, empleados, y la vista vs_equipo, utilizado en la vista create y edit

        /*
        $edit = Ip::join('vs_equipos', 'vs_equipos.id', '=', 'ips.id_equipo')
            ->join('empleados', 'empleados.id', '=', 'vs_equipos.id_resguardante')
            ->select('vs_equipos.id', 'vs_equipos.id_resguardante', 'empleados.nombre', 'vs_equipos.udg_id', 'vs_equipos.numero_serie', 'vs_equipos.mac', 'vs_equipos.tipo_equipo', 'vs_equipos.area')
            ->where('ips.id', '=', $id)
            ->first();

        $equipos = Ip::select('id_equipo')->get();
        */

        /*$vs_equipos = VsEquipo::select('vs_equipos.id', 'vs_equipos.id_resguardante', Empleado::raw('COUNT(empleados.id) as empleados_count'), 'vs_equipos.udg_id', 'vs_equipos.numero_serie', 'vs_equipos.mac', 'vs_equipos.tipo_equipo', 'vs_equipos.area', Empleado::raw('IFNULL(empleados.nombre, "Sin nombre disponible") AS nombre'))
            ->leftJoin('empleados', 'empleados.id', '=', 'vs_equipos.id_resguardante')
            ->whereIn('vs_equipos.tipo_equipo', ['Access Point', 'Cámara', 'Cámara de Red', 'CPU', 'Impresora', 'Multifuncional', 'Laptop', 'Router', 'Servidor', 'Switch', 'Teléfono'])
            ->groupBy('vs_equipos.id')
            ->get();
        // $vs_equipos ahora contiene los resultados sin los equipos presentes en $equipos
        foreach ($vs_equipos as $key => $vs_equipo) {
            foreach ($equipos as $equipo) {
                if ($vs_equipo->id === $equipo->id_equipo) {
                    unset($vs_equipos[$key]);
                }
            }
        }*/

        //return '<br>'.$equipos.'<br><br>'.$vs_equipos

        if ($ip->id_equipo == 0) {
            return view('ips.edit')
                ->with('ip', $ip)
                ->with('subred', $subred);
            // ->with('edit', $edit);

        } else {
            return view('ips.edit1')
                ->with('ip', $ip)
                ->with('subred', $subred);
            //->with('edit', $edit);

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\subred  $ip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $this->validate(
            $request,
            [
                'id_equipo' => 'required|unique:ips,id_equipo',
            ],
            [
                'unique' => 'El Equipo ya fue asignado.',
                'required' => 'Equipo no seleccionado.',
            ],
        );

        $ip = Ip::find($id);
        $ip->id_equipo = $request->id_equipo;
        $ip->ocupada = 'si';
        $ip->update();
        return redirect()
            ->route('ocupadas', $ip->Subred_id)
            ->with(['message' => 'Se asignó un equipo a la IP.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ip  $ip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ip $ip)
    {
        //
    }

    public function filtroIps(Request $request)
    {
        if ($request->input('id') == 0) {
            return redirect()
                ->route('ips.index')
                ->with(['error' => 'Filtros no seleccionados']);
        }

        $subredes = Subred::where('activo', '=', 1)->get();
        $subred = $request->input('id');
        //$estatus = $request->input('estatus');
        $subredElegida = Subred::find($subred);
        $disponibleElegida = $request->input('ocupadas');

        if (isset($subred) && !is_null($subred)) {
            if ($disponibleElegida == 0) {
                $filtro = Vs_Ips_Subredes::where('vlan', '=', $subredElegida->vlan)
                    ->where('activo', '=', 1)
                    ->get();

                $ips = $this->cargarDTall($filtro);
            } elseif ($disponibleElegida == 1) {
                $filtro = Vs_Ips_Subredes::where('vlan', '=', $subredElegida->vlan)
                    ->where('activo', '=', 1)
                    ->where('ocupada', '=', 'si')
                    ->get();

                $ips = $this->cargarDTall($filtro);
            } else {
                $filtro = Vs_Ips_Subredes::where('vlan', '=', $subredElegida->vlan)
                    ->where('activo', '=', 1)
                    ->where('ocupada', '=', 'no')
                    ->get();

                $ips = $this->cargarDTall($filtro);
            }
        } else {
            $ips = Vs_Ips_Subredes::where('activo', '=', 1)->get();
        }
        return view('ips.index')
            ->with('ips', $ips)
            ->with('subredes', $subredes)
            ->with('subredElegida', $subredElegida)
            ->with('disponibleElegida', $disponibleElegida);
    }
    public function filtroIpsasig(Request $request)
    {
        $subredes = Subred::where('activo', '=', 1)->get();
        $subred = $request->input('id');
        //$estatus = $request->input('estatus');
        $subredElegida = Subred::find($subred);

        if (isset($subred) && !is_null($subred)) {
            $filtro = VsIps::where('Subred_id', '=', $subred)
                ->where('activo', '=', 1)
                ->get();

            $ips = $this->cargarDT($filtro);
        } else {
            $ips = Ip::where('activo', '=', 1)->get();
        }
        return view('ips.asignadas')
            ->with('ips', $ips)
            ->with('subredes', $subredes)
            ->with('subredElegida', $subredElegida);
    }

    public function asignadas(Request $request)
    {
        $subred = $request->input('id');
        //$estatus = $request->input('estatus');
        $subredElegida = Subred::find($subred);

        if (isset($subred) && !is_null($subred)) {
            $filtro = VsEquipo::join('empleados', 'empleados.id', '=', 'vs_equipos.id_resguardante')
                ->select('empleados.nombre', 'vs_equipos.*')
                ->where('vs_equipos.activo', '=', 1)
                ->get();

            $ips = $this->cargarDT($filtro);
        } else {
            $ips = VsIps::where('activo', '=', 1)->get();
        }
        $subred = Subred::where('activo', '=', 1)->get();
        $ips = $this->cargarDT($ips);

        return view('ips.asignadas')
            ->with('ips', $ips)
            ->with('subredes', $subred);
    }

    public function delete_ip($id)
    {
        $ip = Ip::select('ips.id', 'ips.id_equipo', 'ips.Subred_id')
            ->where('ips.id', '=', $id)
            ->first();

        if ($ip->id_equipo == 0) {
            $ip->activo = 0;
            $ip->update();

            return redirect()
                ->route('disponible', $ip->Subred_id)
                ->with(['message' => 'La IP se ha eliminado correctamente']);
        } else {
            return redirect()
                ->route('ocupadas', $ip->Subred_id)
                ->with([
                    'error' => 'La IP que trata de eliminar está en uso por un equipo, si desea eliminarla necesita desasignar el equipo',
                ]);
        }
    }
    //filtrar por ip
    public function filtro_p_ip(Request $request)
    {
        if ($request->input('ipb') == 0) {
            return redirect()
                ->route('ips.index')
                ->with(['error' => 'Filtros no seleccionados']);
        }
        $subredes = Subred::where('activo', '=', 1)->get();
        $ips = Ip::where('activo', '=', 1)->get();
        $ip = $request->input('ipb');
        //ip a buscar
        $ipElegida = Ip::where('ip', '=', $ip)->get();

        if (isset($ip) && !is_null($ip)) {
            if ($ipElegida) {
                $filtro = Vs_Ips_Subredes::where('ip', '=', $ip)->get();

                $ips = $this->cargarDTall($filtro);
            }
        } else {
            $ips = Ip::where('activo', '=', 1)->get();
        }
        return view('ips.index')
            ->with('ips', $ips)
            ->with('subredes', $subredes)
            ->with('ipElegida', $ipElegida);
    }

    public function desasignarEquipo($ip)
    {
        $ip = Ip::where('ip',$ip)->first();
        $ip->id_equipo = 0;
        $ip->ocupada = 'no';
        $ip->update();
        return redirect()
            ->route('disponible', $ip->Subred_id)
            ->with(['message' => 'Equipo desasignado']);
    }


    public function buscar_equipo($equipo)
    {

        $equipo = VsEquipo::where('activo', 1)->whereIn('tipo_equipo',  ['Access Point', 'Cámara', 'Cámara de Red', 'CPU', 'Impresora', 'Multifuncional', 'Laptop', 'Router', 'Servidor', 'Switch', 'Teléfono'])
            ->where('id', $equipo)->orwhere('udg_id', $equipo)->orwhere('numero_serie', $equipo)->first();
        return $equipo;
    }
}

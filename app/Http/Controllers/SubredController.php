<?php

namespace App\Http\Controllers;

use App\Models\Ip;
use App\Models\Subred;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\VsEquipo;
use App\Models\Empleado;
use App\Models\VsIps;
use compra;
use Nette\Utils\Strings;
use PHPUnit\Framework\Constraint\Count;

class SubredController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subredes = Subred::where('activo', '=', 1)->get();
        $listasubredes = $this->cargarDT($subredes);

        return view('subredes.index')
            ->with('subredes', $subredes)
            ->with('listasubredes', $listasubredes);
    }
    public function cargarDT($consulta)
    {
        $listasubredes = [];

        foreach ($consulta as $key => $value) {
            $ruta = 'eliminar' . $value['id'];
            $eliminar = route('deletesubred', $value['id']);
            $actualizar = route('subredes.edit', $value['id']);
            $ip = 'ips' . $value['id'];
            $disponible = route('disponible', $value['id']);
            $ocupada = route('ocupadas', $value['id']);
            //Visualización de número de IP´S totales que se generan al crear la subred
            $ipsD = Ip::join('subredes', 'ips.Subred_id', '=', 'subredes.id')
                ->select('ips.ocupada')
                ->Where('ips.Subred_id', '=', $value['id'])
                ->Where('ips.ocupada', '=', 'no')
                ->get();
            $ID = count($ipsD);

            $ipsO = Ip::join('subredes', 'ips.Subred_id', '=', 'subredes.id')
                ->select('ips.ocupada')
                ->Where('ips.Subred_id', '=', $value['id'])
                ->Where('ips.ocupada', '=', 'si')
                ->get();
            $IO = count($ipsO);

            $acciones =
                '
                <div class="btn-acciones">
                    <div class="btn-circle">

                        <a href="' .
                $actualizar .
                '" class="btn btn-success" title="Actualizar">
                            <i class="far fa-edit"></i>
                        </a>

                        <a href="#' .
                $ruta .
                '" role="button" class="btn btn-danger" data-toggle="modal" title="Eliminar">
                            <i class="far fa-trash-alt"></i>
                        </a>


                    </div>
                </div>
                <div class="modal fade" id="' .
                $ruta .
                '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar esta Subred?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p class="text-primary">
                        <small>
                           ID:   ' .
                $value['id'] .
                '.<br>
                           VLAN: ' .
                $value['vlan'] .
                '.<br>
                           Rango de IP : ' .
                $value['rangoInicial'] .
                ' al ' .
                $value['rangoFinal'] .
                '.<br>
                           Gateway: ' .
                $value['gateway'] .
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

            <div class="modal fade" id="' .
                $ip .
                '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">VLAN:' .
                $value['vlan'] .
                '</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p class="text-primary">
                            <a href="' .
                $disponible .
                '" type="button" class="btn btn-success">Disponibles <br>' .
                $ID .
                '</a>
                            <a href="' .
                $ocupada .
                '" type="button" class="btn btn-info">Ocupadas <br>' .
                $IO .
                '</a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            ';

            $ips = Ip::join('subredes', 'ips.Subred_id', '=', 'subredes.id')
                ->select('ips.ocupada')
                ->Where('ips.Subred_id', '=', $value['id'])
                ->Where('ips.activo', '=', 1)
                ->get();
            $num = count($ips);

            $listasubredes[$key] = ['<center>' . $value['vlan'] . '</center>', '<center>' . $value['rangoInicial'] . '</center>', '<center>' . $value['rangoFinal'] . '</center>', '<center>' . $value['gateway'] . '</center>', '<center>' . $value['descripcion'] . '</center>', '<center><a href="#' . $ip . '" role="button" class="btn btn-outline-info" data-toggle="modal" title="listado de IPS">' . $num . '</a></center>', '<center>' . $acciones];
        }

        return $listasubredes;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subred = Subred::where('activo', '=', 1)->get();

        return view('subredes.create')->with('subredes', $subred);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $this->validate(
            $request,
            [
                'vlan' => 'numeric|required|unique:subredes,vlan',
                'rangoInicial' => 'required',
                'rangoFinal' => 'required',
                'gateway' => 'required',
                'descripcion' => 'required',
            ],
            [
                'unique' => 'El número de vlan ya está registrado',
                'required' => 'El campo :attribute es requerido.',
            ],
        );
        $subred = new Subred();
        $Nvlan = Subred::select('subredes.vlan', 'subredes.activo')->get();
        $tamano = count($Nvlan);
        //Datos extraídos del formulario para almacenar
        $subred->vlan = $request->input('vlan');
        $subred->rangoInicial = $request->input('rangoInicial');
        $subred->rangoFinal = $request->input('rangoFinal');
        $subred->gateway = $request->input('gateway');
        $subred->descripcion = $request->input('descripcion');
        $subred->disponible = 'si';
        $subred->activo = 1;
        //Extraer el último octeto del rango Inicial
        $rangoInicial = explode('.', $request->input('rangoInicial'));
        //Volverlo un valor entero
        $rI = intval($rangoInicial[3]);
        //Extraer el último octeto del rango Final
        $rangoFinal = explode('.', $request->input('rangoFinal'));
        //Volverlo un valor entero
        $rF = intval($rangoFinal[3]);
        $subred->Nvlan = $request->input('vlan');
        $subred->save();

        //Generador de IP'S mediante el rango inicial y final de la VLAN
        for ($i = $rI; $i <= $rF; $i++) {
            //Unir los cuatro Octetos para crear la IP considerando la separación por punto
            $ips = intval($rangoInicial[0]) . '.' . intval($rangoInicial[1]) . '.' . intval($rangoInicial[2]) . '.' . $i;
            //inserción de datos a la tabla IPS
            $ip = new Ip();
            $ip->Subred_id = $subred['id'];
            $ip->ip = $ips;
            $ip->id_equipo = 0;
            $ip->ocupada = 'no';
            $ip->save();
        }
        return redirect()
            ->route('subredes.index')
            ->with(['message' => "La subred se ha creado y las IP'S correspondientes al rango especificado"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\subred  $subred
     * @return \Illuminate\Http\Response
     */

    public function show($subred)
    {
        $subredes = Subred::where('activo', '=', 1)->get();

        $subredElegida = Subred::all()
            ->where('subredes.id', '=', $subred)
            ->get();

        $subred = $this->cargarDT($subredElegida);

        $editar = Ip::join('vs_equipos', 'vs_equipos.id', '=', 'ips.id_equipo')
            ->leftJoin('empleados', 'empleados.id', '=', 'vs_equipos.id_resguardante')
            ->join('subredes', 'ips.Subred_id', '=', 'subredes.id')
            ->select('subredes.vlan', 'ips.Subred_id', 'ips.ip', 'ips.id', 'ips.activo', 'ips.ocupada', 'vs_equipos.numero_serie', 'vs_equipos.mac', 'vs_equipos.tipo_equipo', 'vs_equipos.area', 'vs_equipos.udg_id', 'empleados.nombre')
            ->where('ips.Subred_id', '=', $id)
            ->where('ips.activo', '=', 1)
            ->where('ips.ocupada', '=', 'si')
            ->where(function ($query) {
                $query->where('vs_equipos.id_resguardante', '=', 0)->orWhereNotNull('empleados.id');
            })
            ->get();

        return view('subredes.index')
            ->with('subredes', $subred)
            ->with('editar', $editar)
            ->with('subredes', $subredes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\subred  $subred
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subred = Subred::findOrfail($id);
        return view('subredes.edit')->with('subred', $subred);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\subred  $subred
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $validateData = $this->validate(
            $request,
            [
                'vlan' => ['numeric', 'required', 'min:1', Rule::unique('subredes')->ignore($id)],
                'descripcion' => 'required',
            ],
            [
                'unique' => 'El número de VLAN ya fue registrado.',
                'required' => 'El campo es requerido',
            ],
        );
        $subred = Subred::find($id);
        $subred->vlan = $request->input('vlan');
        $subred->descripcion = $request->input('descripcion');
        $subred->nvlan = $request->input('vlan');
        $subred->disponible = 'si';
        $subred->update();

        return redirect('subredes')->with(['message' => 'Los datos de la subred fueron actualizados.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\subred  $subred
     * @return \Illuminate\Http\Response
     */
    public function destroy(subred $subred)
    {
        //
    }

    public function deletesubred($subred_id)
    {
        $subred = Subred::find($subred_id, ['id']);

        $ipTotal = Ip::join('subredes', 'ips.Subred_id', '=', 'subredes.id')
            ->where('ips.Subred_id', '=', $subred_id)
            ->get();

        $ipT = count($ipTotal);

        $ips = Ip::join('subredes', 'ips.Subred_id', '=', 'subredes.id')
            ->select('ips.Subred_id', 'ips.activo')
            ->where('ips.Subred_id', '=', $subred_id)
            ->where('ips.activo', '=', 0)
            ->get();

        $ip = count($ips);
        //comparación para conocer si una VLAN está asignada a una o varias IPs
        if ($ip == $ipT) {
            $subred->vlan = 0;
            $subred->activo = 0;
            $subred->update();

            return redirect()
                ->route('subredes.index')
                ->with([
                    'message' => 'La Subred se ha eliminado correctamente',
                ]);
        } else {
            return redirect()
                ->route('subredes.index')
                ->with([
                    'error' => "La subred que trata de eliminar está activa en una o varias IP'S,
                    para eliminarla necesita borrar todas las IP'S correspondientes a la VLAN ",
                ]);
        }
    }
    public function filtroIps(Request $request)
    {
        $subredes = Subred::where('activo', '=', 1)->get();
        $subred = $request->input('id');
        //$estatus = $request->input('estatus');
        $subredElegida = Subred::find($subred);

        if (isset($subred) && !is_null($subred)) {
            $filtro = Ip::where('id_subred', '=', $subred)
                ->where('activo', '=', 1)
                ->get();

            $ips = $this->cargarDT($filtro);
        } else {
            $ips = Ip::where('activo', '=', 1)->get();
        }

        return view('ips.index')
            ->with('ips', $ips)
            ->with('subredes', $subredes)
            ->with('subredElegida', $subredElegida);
    }

    public function disponible($id)
    {
        $Ips = Ip::join('subredes', 'ips.Subred_id', '=', 'subredes.id')
            ->select('ips.*')
            ->Where('ips.Subred_id', '=', $id)
            ->Where('ips.activo', '=', 1)
            ->Where('ips.ocupada', '=', 'no')
            ->get();

        $ips = Ip::join('subredes', 'ips.Subred_id', '=', 'subredes.id')
            ->select('ips.ocupada')
            ->Where('ips.Subred_id', '=', $id)
            ->Where('ips.activo', '=', 1)
            ->Where('ips.ocupada', '=', 'no')
            ->get();
        $num = count($ips);

        $subred = Subred::find($id, ['id']);

        return view('subredes.disponibles')
            ->with('Ips', $Ips)
            ->with('num', $num)
            ->with('subred', $subred);
    }

    public function ocupadas($id)
    {
        $subred = Subred::find($id, ['id']);

        $Ips = Ip::join('vs_equipos', 'vs_equipos.id', '=', 'ips.id_equipo')
            ->join('subredes', 'ips.Subred_id', '=', 'subredes.id')
            ->select('subredes.vlan', 'ips.Subred_id', 'ips.ip', 'ips.id', 'ips.activo', 'ips.ocupada', 'vs_equipos.numero_serie', 'vs_equipos.mac', 'vs_equipos.tipo_equipo', 'vs_equipos.area', 'vs_equipos.udg_id', 'vs_equipos.id_resguardante', 'vs_equipos.resguardante')
            ->where('ips.Subred_id', '=', $id)
            ->where('ips.activo', '=', 1)
            ->where('ips.ocupada', '=', 'si')
            ->get();

        return view('subredes.ocupadas')
            ->with('Ips', $Ips)
            ->with('num', $Ips->count())
            ->with('subred', $subred);
    }

    public function busqueda_equipo(Request $request)
    {
        if ($request->ajax()) {
            $equipo = VsIps::where('id_equipo',  'like', '%' .$request->equipo. '%')
                ->orwhere('udg_id', 'like', '%' .$request->equipo. '%')
                ->orwhere('numero_serie', 'like', '%' .$request->equipo. '%')
                ->orwhere('ip', 'like', '%' .$request->equipo. '%')->get();
            return view('subredes.tabla', compact('equipo'))->render();
        }
        return 0;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Ip;
use App\Models\Subred;
use App\Models\VsIps;
use Illuminate\Http\Request;

class IpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subred = Subred::where('activo','=',1)
            ->get();
        $ip= Ip::where('activo','=',1)
            ->get();
        $ips = $this->cargarDTall($ip);


        return view('ips.index')

            ->with('ips',$ips)
            ->with('subredes', $subred);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ips =Ip::all();
        $subred = Subred::where('activo','=',1)
            ->get();

        return view('ips.create')
->with('ips',$ips)
            ->with('subredes', $subred);
    }
    public function cargarDT($consulta)
    {
        $ips = [];

        foreach ($consulta as $key => $value){

            $ruta = "eliminar".$value['id'];
            $eliminar = route('delete-ip', $value['id']);
            $actualizar =  route('ips.edit', $value['id']);

            $acciones = '
                <div class="btn-acciones">
                    <div class="btn-circle">
                        <a href="'.$actualizar.'" role="button" class="btn btn-success" data-toggle="modal" title="Actualizar">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="'.$ruta.'" role="button" class="btn btn-danger" data-toggle="modal" title="Eliminar">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </div>
                </div>
                <div class="modal fade" id="'.$ruta.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar esta Ip?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p class="text-primary">
                        <small>
                        Id: '.$value['id'].' /
                           Ip: '.$value['ip'].' /
                           Id_Subred: '.$value['id_subred'].'
                        </small>
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <a href="'.$eliminar.'" type="button" class="btn btn-danger">Eliminar</a>
                    </div>
                  </div>
                </div>
              </div>
            ';
            $ips[$key] = array(
                $acciones,
                $value['subred'],
                $value['ip'],
                $value['marca'],
                $value["modelo"],
                $value['numero_serie'],
                $value['mac'],
                $value['udg_id'],
                $value['id_equipo'],
                $value['area'],



            );

        }

        return $ips;
    }
    public function cargarDTall($consulta)
    {
        $ipsdisp = [];

        foreach ($consulta as $key => $value){

            $ruta = "eliminar".$value['id'];
            $eliminar = route('delete-ip', $value['id']);
            $actualizar =  route('ips.edit', $value['id']);

            $acciones = '
                <div class="btn-acciones">
                    <div class="btn-circle">
                        <a href="' . $actualizar . '" class="btn btn-success" title="Actualizar">
                            <i class="far fa-edit"></i>
                        </a>
                        <a href="'.$eliminar.'" role="button" class="btn btn-danger" data-toggle="modal" title="Eliminar">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </div>
                </div>
                <div class="modal fade" id="'.$ruta.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar esta Ip?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p class="text-primary">
                        <small>
                        Id: '.$value['id'].' /
                           Ip: '.$value['ip'].' /
                           Id_Subred: '.$value['id_subred'].'
                        </small>
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <a href="'.$eliminar.'" type="button" class="btn btn-danger">Eliminar</a>
                    </div>
                  </div>
                </div>
              </div>
            ';
            $ipsdisp[$key] = array(
                $acciones,
                $value['ip'],
                $value['disponible'],
                $value['id subred'],



            );

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
        $validateData = $this->validate($request,[

            'id_subred'=>'required',
            'ip'=>'required|unique:ips,ip',
            'disponible'=>'required',

        ]);
        $subred = Subred::where('id', '=', $request->input('id_subred'))->get()->first();


        $ip= new Ip();
        $ip->id_subred=$subred->id;
        $ip->ip = $request->input('ip');
        $ip->disponible = $request->input('disponible');
        $ip->save();
        return redirect('ips')->with(array(
            'message'=>'Ip añadida'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ip  $ip
     * @return \Illuminate\Http\Response
     */
    public function show( $ip)
    {
       $subredes = Subred::where('activo','=',1)
           ->get();
       $direccion = VsIps::where('activo','=',1)
           ->were('id','=',$ip)
        ->get();
       $ips =$this->cargarDT($direccion);
       return view('ips.index')
           ->with('ips',$ips)
           ->with('subredes',$subredes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ip  $ip
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

        {
            $ip = Ip::find($id);

            $subredes = Subred::where('activo', '=', 1)
                ->get();

            return view('ips.edit')
                ->with('ip', $ip)
                ->with('subredes', $subredes);
        }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\subred  $ip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $validateData = $this->validate($request,[
            'ip' => 'required',
            'disponible' => 'required',
            'id_subred'=>'required',

        ]);

        $ip= Ip::find($id);
        $ip->ip = $request->input('ip');
        $ip->disponible = $request->input('disponible');
        $ip->id_subred =$request->input('id_subred');
        $ip->update();
        return redirect('ips')->with(array(
            'message'=>'Ip actualizada'
        ));
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

    public function filtroIps(Request $request){
        $subredes= Subred::where('activo','=',1)
            ->get();
        $subred = $request->input('id');
        //$estatus = $request->input('estatus');
        $subredElegida = Subred::find($subred);


        if((isset($subred) && !is_null($subred))){
            $filtro = Ip::where('id_subred','=',$subred)
                ->where('activo','=', 1)
                ->get();

            $ips = $this->cargarDTall($filtro);

        } else {
            $ips = Ip::where('activo','=',1)->get();
        }

        return view('ips.index')
            ->with('ips',$ips)
            ->with('subredes',$subredes)
            ->with('subredElegida',$subredElegida);

    }
    public function filtroIpsasig(Request $request){
        $subredes= Subred::where('activo','=',1)
            ->get();
        $subred = $request->input('id');
        //$estatus = $request->input('estatus');
        $subredElegida = Subred::find($subred);


        if((isset($subred) && !is_null($subred))){
            $filtro = VsIps::where('id_subred','=',$subred)
                ->where('activo','=', 1)
                ->get();

            $ips = $this->cargarDT($filtro);

        } else {
            $ips = Ip::where('activo','=',1)->get();
        }

        return view('ips.asignadas')
            ->with('ips',$ips)
            ->with('subredes',$subredes)
            ->with('subredElegida',$subredElegida);

    }


    public function asignadas(Request $request){

        $subred = $request->input('id');
        //$estatus = $request->input('estatus');
        $subredElegida = Subred::find($subred);


        if((isset($subred) && !is_null($subred))){
            $filtro = VsIps::where('id_subred','=',$subred)
                ->where('activo','=', 1)
                ->get();

            $ips = $this->cargarDT($filtro);

        } else {
            $ips = VsIps::where('activo','=',1)->get();
        }

        $subred = Subred::where('activo','=',1)
            ->get();
        $ips = $this->cargarDT($ips);


        return view('ips.asignadas')

            ->with('ips',$ips)
            ->with('subredes', $subred);

    }

    public function delete_ip($ip_id){

        $ip = Ip::find($ip_id);

        if($ip){

            $ip->activo = 0;
            $ip->update();

            return redirect()->route('ips.index')->with(array(
                "message" => "La ip se ha eliminado correctamente"
            ));

        }else{

            return redirect()->route('home')->with(array(
                "message" => "La ip que trata de eliminar no existe"
            ));
        }

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Requisicion;
use App\Models\Articulos_requisiones;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;
use App\Models\User;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;




class RequisicionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $datosrequisiciones = Requisicion::All();
        $requisiciones = $this->cargarDT($datosrequisiciones);
        return view('requisiciones.index')->with('requisiciones', $requisiciones);
    }
    public function cargarDT($consulta)
    {
        $requisiciones = [];


        foreach ($consulta as $key => $value){

            $req_articulos = Articulos_requisiones::where('requisicion_id', $value->id)->get();
            $art_length  = count($req_articulos);
            $index = 0;
            $actualizar =  route('requisicions.edit', $value['id']);

            $acciones = '
                <div class="btn-acciones">
                    <div class="btn-circle">
                        <a href="'.$actualizar.'" class="btn btn-success" title="Actualizar">
                            <i class="far fa-edit"></i>
                        </a>
                    </div>
                </div>

            ';

            $vs_articulos_array = '';
            if($index < $art_length){
              // wrong! (for needed)

              for ($i=0; $i < $art_length; $i++) {
                  $vs_articulos = '
                      <td>
                        <p class="text-muted"> Articulo: '.($i+1).' </p>
                        <ul >
                          <li style="padding: 5px;"> <strong> Codigo</strong>: '. $codigo = $req_articulos[$i]->codigo .'</li>
                          <li style="padding: 5px;"> <strong> Cantidad</strong>:'. $cantidad = $req_articulos[$i]->cantidad .'</li>
                          <li style="padding: 5px;"> <strong> Descripcion</strong>: '. $descripcion = $req_articulos[$i]->descripcion .'</li>
                          <li style="padding: 5px;"> <strong> Observaciones</strong>:'. $observaciones = $req_articulos[$i]->observaciones .'</li>
                        </ul>
                      </td>
                  ';
                  $vs_articulos_array =  $vs_articulos_array . $vs_articulos;
              }


            }



            $requisiciones[$key] = array(
                $acciones,
                $vs_articulos_array,
                // $value['req_articulos'],
                $value['num_solicitud'],
                $value['fecha'],
                $value['user_id'],
                $value['proyecto'],
                $value['fondo'],
                $value['fecha_recibido'],
                $value['quien_recibio'],
                $value['id']
            );
            $index++;

        }
        // dd($vs_articulos_array);

        return $requisiciones;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('requisiciones.create');

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
         'num_solicitud'=>'required',
         'fecha'=>'required',
         'proyecto'=>'required',
         'fondo'=>'required',
         'fecha_recibido'=>'required',
         'quien_recibio'=>'required'
     ]);
     $requisicion = new Requisicion();
    //  $requisicion->id = $request->input('id');
     $requisicion->num_solicitud = $request->input('num_solicitud');
     $requisicion->fecha = $request->input('fecha');
     $requisicion->user_id = Auth::user()->id;
     $requisicion->proyecto = $request->input('proyecto');
     $requisicion->fondo = $request->input('fondo');
     $requisicion->fecha_recibido = $request->input('fecha_recibido');
     $requisicion->quien_recibio = $request->input('quien_recibio');

     $requisicion->save();

     //articulos_requision

     $convertedArray = explode(',',$request->input('dataTable'));

     $indexArray = 0;
     for ($i=0; $i < count($convertedArray)/4 ; $i++) {
         $articulo = new Articulos_requisiones();
         $articulo->requisicion_id = $requisicion->id;
         $articulo->codigo = $convertedArray[$indexArray];
         // dd($convertedArray[1]);
         $articulo->cantidad = $convertedArray[$indexArray];
         $articulo->descripcion = $convertedArray[$indexArray];
         $articulo->observaciones = $convertedArray[$indexArray];
         $articulo->save();
         $indexArray++;
     }
     return redirect ('requisicions');
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
        $requisicion = Requisicion::find($id);
        return view('requisiciones.edit')->with('requisicion', $requisicion);
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
        $validateData = $this->validate($request,[
            //  'id'=>'required',
             'num_solicitud'=>'required',
             'fecha'=>'required',
             //'user_id'=>'required',
             'proyecto'=>'required',
             'fondo'=>'required',
             'fecha_recibido'=>'required',
             'quien_recibio'=>'required'
         ]);
         $requisicion = Requisicion::find($id);
    //  $requisicion->id = $request->input('id');
     $requisicion->num_solicitud = $request->input('num_solicitud');
     $requisicion->fecha = $request->input('fecha');

     $requisicion->user_id = Auth::user()->id;
     $requisicion->proyecto = $request->input('proyecto');
     $requisicion->fondo = $request->input('fondo');
     $requisicion->fecha_recibido = $request->input('fecha_recibido');
     $requisicion->quien_recibio = $request->input('quien_recibio');

     $requisicion->save();
     return redirect ('requisicions')->with('requisicion', $requisicion);



    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
    }

    public function delete(){


    }



}

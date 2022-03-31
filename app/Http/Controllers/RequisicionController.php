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

              $vs_articulos1 = '
                  <td>
                    <p class="text-muted text-center"> Codigos de articulos: </p>';
              $vs_articulos_array = $vs_articulos_array . $vs_articulos1;

              for ($i=0; $i < $art_length; $i++) {
                  $vs_articulos2 = '
                        <ul>
                          <li> <p class="text-muted"> '. $codigo = $req_articulos[$i]->codigo .' </p> </li>
                        </ul>
                      </td>
                  ';
                  $vs_articulos_array =  $vs_articulos_array . $vs_articulos2 ;
              }
            }else if($art_length == 0){
              $vs_articulos = '
                  <td>
                    <p class="text-muted text-center"> No hay articulos</p>
                  </td>
              ';
              $vs_articulos_array =  $vs_articulos_array . $vs_articulos;
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

     //articulos_requision//

     $convertedArray = explode(',',$request->input('dataTable'));

     $index_array = 0;
     $count = count($convertedArray)/4;
     if($count > 1){
       for ($i=0; $i < $count ; $i++) {
           $articulo = new Articulos_requisiones();
           $articulo->requisicion_id = $requisicion->id;
           $articulo->codigo = $convertedArray[$index_array++];
           // dd($convertedArray[1]);
           $articulo->cantidad = $convertedArray[$index_array++];
           $articulo->descripcion = $convertedArray[$index_array++];
           $articulo->observaciones = $convertedArray[$index_array++];
           $articulo->save();
       }
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
        $array_articles = Articulos_requisiones::where('requisicion_id', $requisicion->id)->get();
        return view('requisiciones.edit')
        ->with('requisicion', $requisicion)
        ->with('array_articles', $array_articles)
        ;
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
      $convertedArray = explode(',',$request->input('dataTable'));
      // dd($convertedArray);

        $validateData = $this->validate($request,[
             'num_solicitud'=>'required',
             'fecha'=>'required',
             'proyecto'=>'required',
             'fondo'=>'required',
             'fecha_recibido'=>'required',
             'quien_recibio'=>'required'
         ]);
       $requisicion = Requisicion::find($id);

       $requisicion->num_solicitud = $request->input('num_solicitud');
       $requisicion->fecha = $request->input('fecha');
       $requisicion->user_id = Auth::user()->id;
       $requisicion->proyecto = $request->input('proyecto');
       $requisicion->fondo = $request->input('fondo');
       $requisicion->fecha_recibido = $request->input('fecha_recibido');
       $requisicion->quien_recibio = $request->input('quien_recibio');

       $requisicion->update();

     $index_array = 0;
     $array_existedArray = [];
     $count = intval(count($convertedArray)/5 );
     $OldArticles = Articulos_requisiones::where('requisicion_id', $requisicion->id)->delete();
     if($count > 0){
       // dd($count);
       for ($i=0; $i < $count ; $i++) {
           $inputId = $convertedArray[$index_array++];

           $ArticuledFinded = Articulos_requisiones::find($inputId);
           $articulo = new Articulos_requisiones();
           $articulo->requisicion_id = $requisicion->id;
           $articulo->codigo = $convertedArray[$index_array++];
           $articulo->cantidad = $convertedArray[$index_array++];
           $articulo->descripcion = $convertedArray[$index_array++];
           $articulo->observaciones = $convertedArray[$index_array++];
           $articulo->save();

           // if($ArticuledFinded){//update
           //   $ArticuledFinded->requisicion_id = $requisicion->id;
           //   $ArticuledFinded->codigo = $convertedArray[$index_array++];
           //   $ArticuledFinded->cantidad = $convertedArray[$index_array++];
           //   $ArticuledFinded->descripcion = $convertedArray[$index_array++];
           //   $ArticuledFinded->observaciones = $convertedArray[$index_array++];
           //   $array_existedArray[$i] = $ArticuledFinded->id;
           //
           //   $ArticuledFinded->update();
           //
           // }else{ //create
           //   // dd($convertedArray);
           //   $articulo = new Articulos_requisiones();
           //   $articulo->requisicion_id = $requisicion->id;
           //   $articulo->codigo = $convertedArray[$index_array++];
           //   $articulo->cantidad = $convertedArray[$index_array++];
           //   $articulo->descripcion = $convertedArray[$index_array++];
           //   $articulo->observaciones = $convertedArray[$index_array++];
           //   $articulo->save();
           //
           //   $array_existedArray[$i] = $articulo->id;
           //
           // }
           }

       }
       // $arts_delete = Articulos_requisiones::where('requisicion_id',$requisicion->id)
       // ->whereNotIn('id',$array_existedArray)->delete();



     return redirect ('requisicions');
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

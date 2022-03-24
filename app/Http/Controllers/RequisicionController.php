<?php

namespace App\Http\Controllers;

use App\Models\Requisicion;
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
      
        $datosrequisiciones = Requisicion :: All ();
        $requisiciones = $this->cargarDT($datosrequisiciones);
        return view('requisiciones.index')->with('requisiciones', $requisiciones);
    }
    public function cargarDT($consulta)
    {
        $requisiciones = [];

        foreach ($consulta as $key => $value){

            
            $actualizar =  route('requisicions.edit', $value['id']);
            //$recibo = route('recepcionEquipo',  $value['id']);

            $acciones = '
                <div class="btn-acciones">
                    <div class="btn-circle">
                        <a href="'.$actualizar.'" class="btn btn-success" title="Actualizar">
                            <i class="far fa-edit"></i>
                        </a>
			
                        
                
                    
                  </div>
                </div>
              
            ';

            $requisiciones[$key] = array(
                $acciones,
                
                $value['num_solicitud'],
                $value['fecha'],
                $value['user_id'],
                $value['proyecto'],
                $value['fondo'],
                $value['fecha_recibido'],
                $value['quien_recibio'],
                $value['id']
            );

        }

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
        //  'id'=>'required',
         'num_solicitud'=>'required',
         'fecha'=>'required',
        // 'user_id'=>'required',
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
     return redirect ('requisicions')->with('requisicion', $requisicion);
     
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

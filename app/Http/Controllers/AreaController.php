<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Log;
use App\Models\VsAreaTicket;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::where('activo','=',1)->get();
        $areas = $this->cargarDT($areas );
        return view('areas.index')->with('areas',$areas);
    }
    public function cargarDT($consulta)
    {
        $area = [];

        foreach ($consulta as $key => $value){

            $ruta = "eliminar".$value['id'];
            $eliminar = route('delete-area', $value['id']);
            $actualizar =  route('areas.edit', $value['id']);
         

            $acciones = '
                <div class="btn-acciones">
                    <div class="btn-circle">
                        <a href="'.$actualizar.'" role="button" class="btn btn-success" data-toggle="modal"  title="Actualizar">
                            <i class="far fa-edit"></i>
                        </a>
                        <a href="#'.$ruta.'" role="button" class="btn btn-danger" data-toggle="modal" title="Eliminar">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </div>
                </div>
                <div class="modal fade" id="'.$ruta.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar este curso?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p class="text-primary">
                        <small> 
                            '.$value['id'].', '.$value['descripcion'].'                 </small>
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

            $area[$key] = array(
                $acciones,
                $value['id'],
                $value['tipo_espacio'],
                $value['sede'],
                $value['edificio'],
                $value['piso'],
                $value['division'],
                $value['coordinacion'],
                $value['area'],
            );

        }

        return $area;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('areas.create');

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
            'tipo_espacio'=>'required',
            'sede'=>'required',
            'edificio'=>'required',
            'piso'=>'required',
            'division'=>'required',
            'coordinacion'=>'required',
            'equipamiento'=>'required',
            'area'=>'required'
        ]);

        $area = new Area();
        $area->tipo_espacio = $request->input('tipo_espacio');
        $area->sede = $request->input('sede');
        $area->edificio = $request->input('edificio');
        $area->piso = $request->input('piso');
        $area->division = $request->input('division');
        $area->coordinacion = $request->input('coordinacion');
        $area->equipamiento = $request->input('equipamiento');
        $area->area = $request->input('area');

        $imagen_1 = $request->file('imagen_1');
        if($imagen_1){
           $image_path = time().$imagen_1->getClientOriginalName();
           \Storage::disk('images')->put($image_path, \File::get($imagen_1));
        
           $area->imagen_1 = $image_path;
         }

        $imagen_2 = $request->file('imagen_2');
        if($imagen_2){
           $image_path = time().$imagen_2->getClientOriginalName();
           \Storage::disk('images')->put($image_path, \File::get($imagen_2));
        
           $area->imagen_2 =$image_path;
         }

        $area->save();
	//
        $log = new Log();
        $log->tabla = "areas";
        $mov="";
        $mov=$mov." tipo_espacio:".$area->tipo_espacio ." sede:". $area->sede ." edificio" .$area->edificio;
        $mov=$mov." piso:".$area->piso ." division:". $area->division ." coordinacion" .$area->coordinacion;
        $mov=$mov." equipamiento:".$area->equipamiento ." area:". $area->area .".";
        $log->movimiento = $mov;
        $log->usuario_id = Auth::user()->id;
        $log->acciones = "Insercion";
        $log->save();
        //
        return redirect('areas')->with(array(
            'message'=>'El área se guardo Correctamente'
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
        $area = Area::find($id);
        return view('areas.edit')->with('area', $area);
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
            'tipo_espacio'=>'required',
            'sede'=>'required',
            'edificio'=>'required',
            'piso'=>'required',
            'division'=>'required',
            'coordinacion'=>'required',
            'equipamiento'=>'required',
            'area'=>'required'
        ]);

        $area = Area::find($id);
        $area->tipo_espacio = $request->input('tipo_espacio');
        $area->sede = $request->input('sede');
        $area->edificio = $request->input('edificio');
        $area->piso = $request->input('piso');
        $area->division = $request->input('division');
        $area->coordinacion = $request->input('coordinacion');
        $area->equipamiento = $request->input('equipamiento');
        $area->area = $request->input('area');

        $imagen_1 = $request->file('imagen_1');
        if($imagen_1){
           $image_path = time().$imagen_1->getClientOriginalName();
           \Storage::disk('images')->put($image_path, \File::get($imagen_1));
        
           $area->imagen_1 =$image_path;
         }

        $imagen_2 = $request->file('imagen_2');
        if($imagen_2){
           $image_path = time().$imagen_2->getClientOriginalName();
           \Storage::disk('images')->put($image_path, \File::get($imagen_2));
        
           $area->imagen_2 =$image_path;
         }

        $area->update();
	//
        $log = new Log();
        $log->tabla = "areas";
        $mov="";
        $mov=$mov." tipo_espacio:".$area->tipo_espacio ." sede:". $area->sede ." edificio" .$area->edificio;
        $mov=$mov." piso:".$area->piso ." division:". $area->division ." coordinacion" .$area->coordinacion;
        $mov=$mov." equipamiento:".$area->equipamiento ." area:". $area->area .".";
        $log->movimiento = $mov;
        $log->usuario_id = Auth::user()->id;
        $log->acciones = "Edicion";
        $log->save();
        //
        return redirect('areas')->with(array(
            'message'=>'El área se actualizo Correctamente'
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

    public function delete_area($area_id){
        $area = Area::find($area_id);
        if($area){
            $area->activo = 0;
            $area->update();
	    //
            $log = new Log();
            $log->tabla = "areas";
            $mov="";
            $mov=$mov." tipo_espacio:".$area->tipo_espacio ." sede:". $area->sede ." edificio" .$area->edificio;
            $mov=$mov." piso:".$area->piso ." division:". $area->division ." coordinacion" .$area->coordinacion;
            $mov=$mov." equipamiento:".$area->equipamiento ." area:". $area->area .".";
            $log->movimiento = $mov;
            $log->usuario_id = Auth::user()->id;
            $log->acciones = "Borrado";
            $log->save();
            //
            return redirect()->route('areas.index')->with(array(
               "message" => "El área se ha eliminado correctamente"
            ));
        }else{
            return redirect()->route('home')->with(array(
               "message" => "El área que trata de eliminar no existe"
            ));
        }

    }

   public function getImage($filename){
      $file = Storage::disk('images')->get($filename);
      return new Response($file, 200);
   }

   public function area_ticket($sede)
   {
      $areas = VsAreaTicket::where('sede', '=', $sede)->get();
      
      $comprobar_edificio = "";
      $comprobar_piso = "";
      $comprobar_area = "";

      $cont_edificio = 0;
      $cont_piso = 0;
      $cont_area = 0;

      $arg_edificio = [];
      $arg_piso = [];
      $arg_area = [];

      foreach ($areas as $key => $value) {

         $imagen_1 = $value['imagen_1'];
         $imagen_2 = $value['imagen_2'];

         if ($imagen_1 == "") {
            $imagen_1 = "no_disponible.jpg";
         }

         if ($imagen_2 == "") {
            $imagen_2 = "no_disponible.jpg";
         }

         if ($key > 0) {
            if ($comprobar_edificio != $value['edificio']) {
               $cont_edificio++;
               $arg_edificio[$cont_edificio] = array(
                  "edificio" => $value['edificio'],
                  "sede" => $value['sede'],
                  "piso" => $value['piso'],
                  "area" => $value['area'],
               );
            }

            if ($arg_edificio[$cont_edificio]['edificio'] == $value['edificio'] && $comprobar_piso != $value['piso']) {
               $cont_piso++;
               $arg_piso[$cont_piso] = array(
                  "edificio" =>  $value['edificio'],
                  "piso" => $value['piso'],
                  "area" => $value['area'],
               );
            } 
            
            if($arg_edificio[$cont_edificio]['edificio'] != $arg_piso[$cont_piso]['edificio']) {
               $cont_piso++;
               $arg_piso[$cont_piso] = array(
                  "edificio" =>  $value['edificio'],
                  "piso" => $value['piso'],
                  "area" => $value['area'],
               );
            }
               

            if ($arg_edificio[$cont_edificio]['edificio'] == $value['edificio'] &&
               $arg_piso[$cont_piso]['piso'] == $value['piso'] &&
               $comprobar_area != $value['area']
               ) {
               $cont_area++;
               $arg_area[$cont_area] = array(
                  "edificio" =>  $value['edificio'],
                  "piso" => $value['piso'],
                  "area" => $value['area'],
                  "ticket" => $value['ticket'],
                  "id" => $value['id'],
                  "imagen_1" => $imagen_1,
                  "imagen_2" => $imagen_2,
                  "equipamiento" => $value['equipamiento'],
               );
            }

         } else {
            $arg_edificio[$cont_edificio] = array(
            "edificio" =>  $value['edificio'],
            "sede" => $value['sede'],
            "piso" => $value['piso'],
            "area" => $value['area'],
            );

            $arg_piso[$cont_piso] = array(
               "edificio" =>  $value['edificio'],
               "piso" => $value['piso'],
               "area" => $value['area'],
            );

            $arg_area[$cont_area] = array(
               "edificio" =>  $value['edificio'],
               "piso" => $value['piso'],
               "area" => $value['area'],
               "ticket" => $value['ticket'],
               "id" => $value['id'],
               "imagen_1" => $imagen_1,
               "imagen_2" => $imagen_2,
               "equipamiento" => $value['equipamiento'],
            );
         }

         $comprobar_edificio = $value['edificio'];
         $comprobar_piso = $value['piso'];
         $comprobar_area = $value['area'];

      }

      $arg_resultado = [];
      $num_edificio = 0;
      $num_piso = 0;

      for ($i=0; $i < count($arg_edificio); $i++) { 
         
         $nombre_edificio = str_replace("Edificio ", " ", $arg_edificio[$i]['edificio']);
         
         $arg_resultado[$i] = array(
            "edificio" => $nombre_edificio, 
            "sede"=> $arg_edificio[$i]['sede']
         );

         for ($j=0; $j < count($arg_piso); $j++) { 

            if ($arg_edificio[$i]['edificio'] == $arg_piso[$j]['edificio']) {
               
               $arg_resultado[$i]["piso"][$num_edificio] = array("piso" => $arg_piso[$j]['piso']);

               for ($k=0; $k < count($arg_area); $k++) { 

                  if ($arg_piso[$j]['edificio'] == $arg_area[$k]['edificio'] &&
                        $arg_piso[$j]['piso'] == $arg_area[$k]['piso']
                     ) {

                     $arg_resultado[$i]["piso"][$num_edificio]["area"][$num_piso] = array(
                        "area" => $arg_area[$k]['area'],
                        "ticket" => $arg_area[$k]['ticket'],
                        "id" => $arg_area[$k]['id'],
                        "imagen_1" => $arg_area[$k]['imagen_1'],
                        "imagen_2" => $arg_area[$k]['imagen_2'],
                        "equipamiento" => $arg_area[$k]['equipamiento'],
                     );

                     $num_piso++;    

                  } else {
                     $num_piso=0;
                  }
               }
               $num_edificio++;
            } else {
               $num_edificio=0;
            }

         }
         $nombre_edificio = "";
      }

        //  echo('<pre>');
        //  print_r($arg_resultado);
        //  echo('</pre>');

      return view('areas.area-ticket')->with('areas',$arg_resultado);
   }

}

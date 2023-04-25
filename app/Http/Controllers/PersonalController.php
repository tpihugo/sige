<?php
namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Personal;
use App\Models\Plaza;
use App\Models\Area;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PersonalsExport;
use Dompdf\Dompdf;
use Symfony\Component\HttpFoundation\Response;




use function Symfony\Component\String\b;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    

    public function search(Request $request)
    {

      if($request->ajax()){
        if($request->input('filterBy') == 'nombre'){
          $data = Personal::where('nombre', 'like', '%'.$request->input('filter'). '%')->get();
        }else if($request->input('filterBy') == 'codigo'){
          $data = Personal::where('codigo',$request->input('filter') )->get();
        }
      }

      $output = '';
      if(count($data) > 0){
              foreach ($data as $row) {

                $ruta = "eliminar".$row['id'];
                $eliminar = route('delete-personal', $row['id']);
                $actualizar =  route('personal.edit', $row['id']);
                $acciones = '';

                $acciones = `
                @can('cNormal_PERSONAL#editar')
                    <div class="btn-acciones">
                        <div class="btn-circle">
                            <a href="'.$actualizar.'" class="btn btn-success" title="Actualizar">
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
                          <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar este persoanl?</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <a href="'.$eliminar.'" type="button" class="btn btn-danger">Eliminar</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endcan
                `;



                $output .= '
                <tr>
                  <td>'.$acciones.'</td>
                  <td>'.$row->codigo.'</td>
                  <td>'.$row->apellido_paterno.'</td>
                  <td>'.$row->apellido_materno.'</td>
                  <td>'.$row->nombre.'</td>
                  <td>'.$row->plaza.'</td>
                  <td>'.$row->categoria.'</td>
                  <td>'.$row->carga_horaria.'</td>
                  <td>'.$row->adscripcion.'</td>
                  <td>'.$row->lunes.'</td>
                  <td>'.$row->martes.'</td>
                  <td>'.$row->miercoles.'</td>
                  <td>'.$row->jueves.'</td>
                  <td>'.$row->viernes.'</td>
                  <td>'.$row->sabado.'</td>
                  <td>'.$row->area_fisica.'</td>
                  <td>'.$row->sede.'</td>
                  <td>'.$row->grado_estudios.'</td>
                 
                   </td>
                  <td>

                 </tr> ';
              }
      }else{
        $output = "no data found";
      }
      return $output;
    }

    public function DT_exportExcel()
    {
        $perExport = new PersonalsExport;
        // $perExport->setValue($valueParameter);
        return Excel::download($perExport , 'personal.xlsx' );
    }

    public function DT_exportPDF()
    {
        $query = Personal::select(
            'Codigo',
            'apellido_paterno',
            'apellido_materno',
            'nombre',
            'grado_estudio',
            'plaza',
            'categoria',
            'carga_horaria',
            'adscripcion',
            'lunes',
            'martes',
            'miercoles',
            'jueves',
            'viernes',
            'sabado',
            'area_fisica',
            'sede',
        )->get();

         $dompdf = new Dompdf();
         $dompdf->loadHtml($this->table_to_PDF($query));
         $dompdf->setPaper('A2', 'landscape');
         $dompdf->render();
         $dompdf->stream('Infomes.pdf', ['Attachment'=>false]);
    }

    private function table_to_PDF($query)
    {
        $output = '
              <h3 align="center"> Reporte (100 registros solamente)</h3>
              <table width="100%" style="border-collapse: collapse; border: 0px;">
              <tr>

                  
                  <th style="border: 1px solid; padding:5px;">
                      Código
                  </th>
                  <th style="border: 1px solid; padding:5px;">
                      Apellido_paterno
                  </th>
                  <th style="border: 1px solid; padding:5px;">
                      Apellido_materno
                  </th>
                  <th style="border: 1px solid; padding:5px;">
                      Nombre
                  </th>
                  <th style="border: 1px solid; padding:5px;">
                      Plaza
                  </th>
                  <th style="border: 1px solid; padding:5px;">
                      Categoria
                  </th>
                  <th style="border: 1px solid; padding:5px;">
                      carga_horaria
                  </th>
                  <th style="border: 1px solid; padding:5px;">
                        Adscripcion
                  </th>
                  <th style="border: 1px solid; padding:5px;">
                      lunes
                  </th>
                  <th style="border: 1px solid; padding:5px;">
                      martes
                  </th>
                  <th style="border: 1px solid; padding:5px;">
                      miercoles
                  </th>
                  <th style="border: 1px solid; padding:5px;">
                      jueves
                  </th>
                  <th style="border: 1px solid; padding:5px;">
                      viernes
                  </th>
                  <th style="border: 1px solid; padding:5px;">
                      sabado
                  </th>
                  <th style="border: 1px solid; padding:5px;">
                    Area_fisica
                  </th>
                  <th style="border: 1px solid; padding:5px;">
                    Sede
                  </th>
                  <th style="border: 1px solid; padding:5px;">
                      Grado_estudios
                   </th>
              </tr>
              ';

              $i = 0;
        foreach($query as $row){
            // if($i > 100)
            //     break;
              $output .= '
               <tr>
                   <td style="border: 1px solid; padding:5px;">
                       '.$row->codigo.'
                   </td>
                   <td style="border: 1px solid; padding:5px;">
                      '.$row->apellido_paterno.'
                  </td>

                  <td style="border: 1px solid; padding:5px;">
                       '.$row->apellido_materno.'
                   </td>
                   <td style="border: 1px solid; padding:5px;">
                         '.$row->nombre.'
                     </td>
                     <td style="border: 1px solid; padding:5px;">
                        '.$row->plaza.'
                    </td>
                    <td style="border: 1px solid; padding:5px;">
                        '.$row->categoria.'
                    </td>
                    <td style="border: 1px solid; padding:5px;">
                        '.$row->carga_horaria.'
                    </td>
                    <td style="border: 1px solid; padding:5px;">
                        '.$row->adscripcion.'
                    </td>
                    <td style="border: 1px solid; padding:5px;">
                          '.$row->lunes.'
                      </td>
                      <td style="border: 1px solid; padding:5px;">
                          '.$row->martes.'
                      </td>
                      <td style="border: 1px solid; padding:5px;">
                          '.$row->miercoles.'
                      </td>
                      <td style="border: 1px solid; padding:5px;">
                          '.$row->jueves.'
                      </td>
                      <td style="border: 1px solid; padding:5px;">
                          '.$row->viernes.'
                      </td>
                      <td style="border: 1px solid; padding:5px;">
                          '.$row->sabado.'
                      </td>
                      <td style="border: 1px solid; padding:5px;">
                         '.$row->area_fisica.'
                     </td>
                     <td style="border: 1px solid; padding:5px;">
                         '.$row->sede.'
                     </td>
                     <td style="border: 1px solid; padding:5px;">
                         '.$row->grado_estudios.'
                     </td>
                     

              </tr>
              ';
              $i++;
          }
         $output .= '</table>';
        return $output;
    }
    public function index()
    {
        $vspersonal = Personal::where('activo','=',1)->get();
        $personal = $this->cargarDT($vspersonal);
        return view('personal.index')->with('personal',$personal);
    }
    public function cargarDT($consulta)
    {
        $personal = [];

        foreach ($consulta as $key => $value) {
            $ruta = 'eliminar' . $value['id'];
            $eliminar = route('delete-personal', $value['id']);
            $actualizar = route('personal.edit', $value['id']);

            $acciones =
                '
                <div class="btn-acciones">
                    <div class="btn-circle">
                        <a href="' .
                $actualizar .
                '" role="button" class="btn btn-success" title="Actualizar">
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
                      <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar este empleado?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p class="text-primary">
                        <small>
                            ' .
                $value['id'] .
                ', ' .
                $value['descripcion'] .
                '                 </small>
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <a href="' .
                $eliminar .
                '" type="button" class="btn btn-danger">Eliminar</a>
                    </div>
                  </div>
                </div>
              </div>
            ';


            //$temp = "<a href='". $this->getImage($value['documento']) ."' > Ver documento <a/>";
            
            

            $personal[$key] = [
            $value['codigo'], 
            $value['apellido_paterno'], 
            $value['apellido_materno'], 
            $value['nombre'], 
            $value['plaza'],
            $value['carga_horaria'], 
            $value['categoria'], 
            $value['adscripcion'],
            $value['area_fisica'],
            $value['sede'],
            "<a href='". url('/storage/documentos/'. $value['documento']) ."' target='blank_'> Ver documento <a/>",
            "Lunes: ".$value['lunes'].
            "<ol/>Martes: ".$value['martes'].
            "<ol/>Miércoles: ".$value['miercoles'].
            "<ol/>Jueves: ".$value['jueves'].
            "<ol/>Viernes: ".$value['viernes'].
            "<ol/>Sábado: ".$value['sabado'], 
            $value['grado_estudios'],
            $acciones];
        }

        return $personal;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$plaza = Personal::distinct()->orderby('plaza','asc')->get(['plaza']);
        $plazas = Plaza::all();
        $Area = Area::all();
        return view('personal.create');
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
            'codigo'=>'required',   
            'apellido_paterno'=>'required',
            'apellido_materno'=>'required',
            'nombre'=>'required',
            'grado_estudios'=>'required',
            'plaza'=>'required',
            'categoria'=>'required',
            'carga_horaria'=>'required|numeric|min:0',
            'adscripcion'=>'required',
            'lunes'=>'required',
            'martes'=>'required',
            'miercoles'=>'required',
            'jueves'=>'required',
            'viernes'=>'required',
            'sabado'=>'required',
            'area_fisica'=>'required',
            'sede'=>'required',
            ''
        ]);

        $personal = new Personal();
        $personal->activo = '1';
        $personal->codigo = $request->input('codigo');
        $personal->apellido_paterno = $request->input('apellido_paterno');
        $personal->apellido_materno = $request->input('apellido_materno');
        $personal->nombre = $request->input('nombre');
        $personal->plaza = $request->input('plaza');
        $personal->categoria = $request->input('categoria');
        $personal->carga_horaria = $request->input('carga_horaria');
        $personal->adscripcion = $request->input('adscripcion');
        $personal->lunes = $request->input('lunes');
        $personal->martes = $request->input('martes');
        $personal->miercoles = $request->input('miercoles');
        $personal->jueves = $request->input('jueves');
        $personal->viernes = $request->input('viernes');
        $personal->sabado = $request->input('sabado');
        $personal->area_fisica = $request->input('area_fisica');
        $personal->sede = $request->input('sede');
        $personal->grado_estudios = $request->input('grado_estudios');

        if($request->hasFile('pdf'))
        {
            $nombre = $personal->codigo."_".$personal->apellido_paterno."_".$personal->apellido_materno.".pdf";
            $archivo=$request->file('pdf');
            \Storage::disk('documentos')->put($nombre, \File::get($archivo));
            $personal->documento=$nombre;
        }
      
        $personal->save();
	//
        $log = new Log();
        $log->tabla = "nuevo_personal";
        $mov="";
        $mov=$mov." activo: ". $personal->activo ." codigo:". $personal->codigo ." apellido_paterno:". $personal->apellido_paterno ." apellido_materno:" . $personal->apellido_materno . " nombre:".$personal->nombre ." plaza:". $personal->plaza ." categoria:" .$personal->categoria ." carga_horaria:" .$personal->carga_horaria. " adscripcion:" .$personal->adscripcion;
        $mov=$mov." lunes:" .$personal->lunes. " martes:" .$personal->martes. " miercoles:" .$personal->miercoles. " jueves:" .$personal->jueves. " viernes:" .$personal->viernes. " sabado:" .$personal->sabado. " area_fisica:" .$personal->area_fisica. " sede:" .$personal->sede. " grado_estudios:" .$personal->grado_estudios;
        $log->movimiento = $mov;
        $log->usuario_id = Auth::user()->id;
        $log->acciones = "Insercion";
        $log->save();

       
        //
        return redirect('personal')->with([
            'message'=>'El personal se guardó correctamente'
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function show(Personal $personal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $personal = Personal::find($id);
        return view('personal.edit')->with('personal', $personal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $this->validate($request,[
            'codigo'=>'required',
            'apellido_paterno'=>'required',
            'apellido_materno'=>'required',
            'nombre'=>'required',
            'grado_estudios'=>'required',
            'plaza'=>'required',
            'categoria'=>'required',
            'carga_horaria'=>'required',
            'adscripcion'=>'required',
            'lunes'=>'required',
            'martes'=>'required',
            'miercoles'=>'required',
            'jueves'=>'required',
            'viernes'=>'required',
            'sabado'=>'required',
            'area_fisica'=>'required',
            'sede'=>'required',
        ]);

        $personal = Personal::find($id);
        $personal->codigo = $request->input('codigo');
        $personal->apellido_paterno = $request->input('apellido_paterno');
        $personal->apellido_materno = $request->input('apellido_materno');
        $personal->nombre = $request->input('nombre');
        $personal->plaza = $request->input('plaza');
        $personal->categoria = $request->input('categoria');
        $personal->carga_horaria = $request->input('carga_horaria');
        $personal->adscripcion = $request->input('adscripcion');
        $personal->lunes = $request->input('lunes');
        $personal->martes = $request->input('martes');
        $personal->miercoles = $request->input('miercoles');
        $personal->jueves = $request->input('jueves');
        $personal->viernes = $request->input('viernes');
        $personal->sabado = $request->input('sabado');
        $personal->area_fisica = $request->input('area_fisica');
        $personal->sede = $request->input('sede');
        $personal->grado_estudios = $request->input('grado_estudios');

        if($request->hasFile('pdf'))
        {
            $nombre = $personal->codigo."_".$personal->apellido_paterno."_".$personal->apellido_materno.".pdf";
            $archivo=$request->file('pdf');
            \Storage::disk('documentos')->put($nombre, \File::get($archivo));

            $personal->documento=$nombre;
        }
        $personal->update();
	//
        $log = new Log();
        $log->tabla = "nuevo_personal";
        $mov="";
        $mov=$mov." codigo: ".$personal->codigo ." apellido_paterno: ". $personal->apellido_paterno ." apellido_materno: " .$personal->apellido_materno;
        $mov=$mov." nombre: ".$personal->nombre ." plaza: ". $personal->plaza ." categoria " .$personal->categoria ." carga_horaria: " .$personal->carga_horaria. 
        "adscripcion: " .$personal->adscripcion. "lunes: " .$personal->lunes. "martes: " .$personal->martes. "miercoles: " .$personal->miercoles. "jueves: " .$personal->jueves. 
        "viernes: " .$personal->viernes. "sabado: " .$personal->sabado. "area_fisica: " .$personal->area_fisica. "sede" .$personal->sede. "grado_estudios" .$personal->grado_estudios;
        $log->movimiento = $mov;
        $log->usuario_id = Auth::user()->id;
        $log->acciones = "Edicion";
        $log->save();
        //
        return redirect('personal')->with(array(
            'message'=>'El personal se actualizó Correctamente'
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personal $personal)
    {
        //
    }

    public function delete_personal($id){
        $personal = Personal::find($id);
        if($personal){
            $personal->activo = 0;
            $personal->update();
	    //
        $log = new Log();
        $log->tabla = "nuevo_personal";
        $mov="";
        $mov=$mov." codigo:".$personal->codigo ." apellido_paterno:". $personal->apellido_paterno ." apellido_materno:" .$personal->apellido_materno;
        $mov=$mov." nombre:".$personal->nombre ." plaza:". $personal->plaza ." categoria" .$personal->categoria ." carga_horaria" .$personal->carga_horaria. "adscripcion" .$personal->adscripcion. "lunes:" .$personal->lunes. "martes:" .$personal->martes. "miercoles:" .$personal->miercoles. "jueves:" .$personal->jueves. "viernes:" .$personal->viernes. "sabado:" .$personal->sabado. "area_fisica:" .$personal->area_fisica. "sede" .$personal->sede. "grado_estudios" .$personal->grado_estudios;
        $log->movimiento = $mov;
        $log->usuario_id = Auth::user()->id;
            $log->acciones = "Borrado";
            $log->save();
            //
            return redirect()->route('personal.index')->with(array(
               "message" => "El personal se ha eliminado correctamente"
            ));
        }else{
            return redirect()->route('home')->with(array(
               "message" => "El personal que trata de eliminar no existe"
            ));
        }

    }

  
    public function getDocumento($filename){
        $file=\Storage::disk('documentos')->get($filename);
        //dd($file);
        header('Content-type: application/pdf');

        return new Response($file, 200);

        }
   
   

}

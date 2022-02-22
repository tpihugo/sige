<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materiales = Material::all();
        return view('material.index')->with('materials',$materiales);


    }

    public function material()
    {
        $materiales = Material::all();
        return view('views.home')->with('materials',$materiales);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('material.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $materiales = new Material();
        $materiales->titulo = $request->get('titulo');
        $materiales->descripcion = $request->get('descripcion');
        $materiales->formato = $request->get('formato');
        $materiales->etiqueta = $request->get('etiqueta');
        $materiales->tipo_material = $request->get('tipo_material');
        $materiales->duracion = $request->get('duracion');
        $materiales->anio_publicacion = $request->get('anio_publicacion');
        $materiales->participantes = $request->get('participantes');
        if($request->hasfile('file')){

            $nombre = strtr($request->file->getClientOriginalName(), array( " " => "_", "ñ" => "n", "Ñ" => "N", "á" => "a", "Í" => "A", "é" => "e", "É" => "E", "í" => "i", "A�" => "�", "ó" => "o", 'Ó' => "O", "ú" => "u", "Ú" => "U" , "�" => "_", "!"=> "_","#"=> "_","$"=> "_","%"=> "_","&"=> "_","("=> "_",")"=> "_","="=> "_","'"=> "_","+"=> "_","{"=> "_","}"=> "_","["=> "_","]"=> "_","-"=> "_"));
            $file= 'http://148.202.212.210:9000/rpc/cat/archivos/videos/'.$nombre;
            $materiales->file = $file;

        }

        if($request->hasfile('file_preview')){
            $nombre = strtr($request->file('file_preview')->getClientOriginalName(), array( " " => "_", "ñ" => "n", "Ñ" => "N", "á" => "a", "Í" => "A", "é" => "e", "É" => "E", "í" => "i", "A�" => "�", "ó" => "o", 'Ó' => "O", "ú" => "u", "Ú" => "U" , "�" => "_", "!"=> "_","#"=> "_","$"=> "_","%"=> "_","&"=> "_","("=> "_",")"=> "_","="=> "_","'"=> "_","+"=> "_","{"=> "_","}"=> "_","["=> "_","]"=> "_","-"=> "_"));
	$file= 'http://148.202.212.210:9000/rpc/cat/archivos/imagenes_videos/'.$nombre;
            $materiales->file_preview = $file;
        }



        $ftp_server="148.202.212.210";
        $ftp_usuario="admin";
        $ftp_password="50p0rt3NAS";
        $conex_id=ftp_connect($ftp_server);
        ftp_login($conex_id, $ftp_usuario, $ftp_password);

		$source_file=$_FILES['file']['tmp_name'];

		$destino="/mnt/array1/archivos/videos";
		$nombre=$_FILES["file"]['name'];


        $nombre = strtr($request->file->getClientOriginalName(), array( " " => "_", "ñ" => "n", "Ñ" => "N", "á" => "a", "Í" => "A", "é" => "e", "É" => "E", "í" => "i", "A�" => "�", "ó" => "o", 'Ó' => "O", "ú" => "u", "Ú" => "U" , "�" => "_", "!"=> "_","#"=> "_","$"=> "_","%"=> "_","&"=> "_","("=> "_",")"=> "_","="=> "_","'"=> "_","+"=> "_","{"=> "_","}"=> "_","["=> "_","]"=> "_","-"=> "_"));
        ftp_put($conex_id, $destino.'/'.$nombre, $source_file, FTP_BINARY);

        $source_file=$_FILES['file_preview']['tmp_name'];
		$destino="/mnt/array1/archivos/imagenes_videos";
		$nombre=$_FILES["file_preview"]['name'];
        $nombre = strtr($request->file('file_preview')->getClientOriginalName(), array( " " => "_", "ñ" => "n", "Ñ" => "N", "á" => "a", "Í" => "A", "é" => "e", "É" => "E", "í" => "i", "A�" => "�", "ó" => "o", 'Ó' => "O", "ú" => "u", "Ú" => "U" , "�" => "_", "!"=> "_","#"=> "_","$"=> "_","%"=> "_","&"=> "_","("=> "_",")"=> "_","="=> "_","'"=> "_","+"=> "_","{"=> "_","}"=> "_","["=> "_","]"=> "_","-"=> "_"));
        ftp_put($conex_id, $destino.'/'.$nombre, $source_file, FTP_BINARY);
	$materiales->save();

        return redirect('./material')->with('success','Item created successfully!');

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
        $materiales = Material::find($id);
        return view('material.edit')->with('materials',$materiales);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_material(Request $request, $id)
    {
        $material = Material::find($id);
        $material->titulo = $request->get('titulo');
        $material->descripcion = $request->get('descripcion');
        $material->formato = $request->get('formato');
        $material->etiqueta = $request->get('etiqueta');
        $material->tipo_material = $request->get('tipo_material');
        $material->duracion = $request->get('duracion');
        $material->anio_publicacion = $request->get('anio_publicacion');
        $material->participantes = $request->get('participantes');
        $material->save();
        $materials = Material::all();
        return view('material.index',compact('materials'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $materiales = Material::find($id);
        $materiales->update();
        return redirect()->route('material.index');

    }

    public function activeIndex($id)
    {
        $materiales = Material::find($id);
        $materiales->inicio = 1;
        $materiales->save();
        return redirect()->route('material.index');

    }

    public function notActiveIndex($id)
    {
        $materiales = Material::find($id);
        $materiales->inicio = 0;
        $materiales->save();
        return redirect()->route('material.index');


    }

    public function carouselShow($id)
    {
        $materiales = Material::find($id);
        $materiales->carousel = 1;
        $materiales->save();
        return redirect()->route('material.index');

    }

    public function carouselHidden($id)
    {
        $materiales = Material::find($id);
        $materiales->carousel = 0;
        $materiales->save();
        return redirect()->route('material.index');


    }

    public function delete($id)
    {
        $materiales = Material::find($id);
        $materiales->activo = 0;
        $materiales->save();
        return redirect()->route('material.index');


    }

    public function change($id,Request $request){
        [$campo,$valor]=explode(',', $request->campo);

        if($campo == 'inicio'){
            if($valor==1){
                Material::where('id',$id)->update([
                    'inicio'=>0
                ]);
            }else{
                Material::where('id',$id)->update([
                    'inicio'=>1
                ]);
            }

        }
        if($campo == 'carousel'){
            if($valor==1){
                Material::where('id',$id)->update([
                    'carousel'=>0
                ]);
            }else{
                Material::where('id',$id)->update([
                    'carousel'=>1
                ]);
            }

        }
        return redirect()->route('material.index');

    }

    //SOLO BORRADO L�GICO
    /*
     *public function delete_ticket($ticket_id){
    $ticket = Ticket::find($ticket_id);
    if($ticket){
        $ticket->activo = 0;
        $ticket->update();
        return redirect()->route('tickets.index')->with(array(
            "message" => "El ticket se ha eliminado correctamente"
        ));
    }else{
        return redirect()->route('home')->with(array(
            "message" => "El ticket que trata de eliminar no existe"
        ));
    }

}
     *
     */
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class categoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function foros_Filtro()
    {
        $foros = Material::all()->where('tipo_material','Foro');
        return view('categorias.categorias', ['titulo' => 'Foros'])->with('categorias',$foros);
    }
    public function conferencias_Filtro()
    {
        $conferencias = Material::all()->where('tipo_material','Conferencia');
        return view('categorias.categorias',  ['titulo' => 'Conferencias'])->with('categorias',$conferencias);
    }
    public function clases_Magistrales_Filtro()
    {
        $clasesMagistrales = Material::all()->where('tipo_material','Clase magistral');
        return view('categorias.categorias',  ['titulo' => 'Clases magistrales'])->with('categorias',$clasesMagistrales);
    }
    public function video_Conferencias_Filtro()
    {
        $videoConferencias = Material::all()->where('tipo_material','Video conferencia');
        return view('categorias.categorias', ['titulo' => 'Video Conferencias'])->with('categorias',$videoConferencias);
    }
    public function transmisiones_En_Vivo_Filtro()
    {
        $transmisionesEnVivo = Material::all()->where('tipo_material','Transmisión en vivo');
        return view('categorias.categorias', ['titulo' => 'Transmisiones en vivo'])->with('categorias',$transmisionesEnVivo);
    }
    public function todos_los_videos()
    {
        $todos_los_videos = Material::where('activo','=','1')->orderBy('id','desc')->get();
        return view('categorias.categorias',  ['titulo' => 'Todos los videos'])->with('categorias',$todos_los_videos);
    }

}

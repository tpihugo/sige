<?php

namespace App\Http\Controllers;
use App\Models\Libros;
use App\Models\Informacion;
use App\Exports\LibrosExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class LibrosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $libros = Libros::paginate(10);
        $total = count(Libros::all());
        return view('Libros.index',compact('libros','total'));
    }
    public function show($id){
        $libro = Libros::find($id);
        $info = Informacion::where('clasificacion',$libro->clasificacion)->where('tipo','Libros')->get()[0];

        return view('Libros.show',compact('libro','info'));

    }
    public function registro(){
        return view('Libros.create');
    }
    public function edit($id)
    {
        $libros = Libros::find($id);
        $info = Informacion::where('clasificacion',$libros->clasificacion)->where('tipo','Libros')->get()[0];

        return view('Libros.edit', compact('libros', 'info'));
    }
    public function create(Request $request){
        $request->validate([
            'titulo' => 'required',
            'clasificacion' => 'required',
            'fecha_ingreso'=>'required',
        ]);
        $libro = new Libros();

        $info = new Informacion();

        $libro->titulo = $request->titulo ;
        $libro->autor = $request->autor ?? '';
        $libro->clasificacion = $request->clasificacion;
        $libro->anio = $request->anio ?? 0000;
        $libro->editorial = $request->editorial ?? '';
        $libro->lugar_publicacion = $request->lugar_publicacion ?? '';
        $libro->volumen = $request->volumen ?? '';
        $libro->fecha_ingreso = str_replace(' 00:00:00', '',$request->fecha_ingreso);
        $libro->situacion = $request->situacion ?? '';
        $libro->tomo_numero = $request->tomo_numero ?? '';
        $libro->paginas = $request->paginas ?? 0;
        $libro->serie = $request->serie ?? '';
        $libro->isbn_issn = $request->isbn_issn ?? '';
        $libro->space = $request->space ?? '';

        $info->clasificacion = $request->clasificacion;
        $info->tipo = 'Libros';
        $info->obtencion = $request->obtencion ?? '';
        $info->resguardo = $request->resguardo ?? '';
        $info->contenido = $request->contenido ?? '';
        $info->codigo_barras = $request->codigo_barras ?? 0;
        $info->inventario = $request->inventario ?? '';
        $info->fecha_publicacion = $request->fecha_publicacion;

        $libro->save();
        $info->save();

        //$libro = new Libros($request->all());
        return redirect()->route('libros.index');

    }
    public function update(Request $request,$libro){

        $request->validate([
            'titulo' => 'required',
            'clasificacion' => 'required',
            'fecha_ingreso'=>'required',
        ]);
        Libros::where('clasificacion',$libro)->update(
            ['clasificacion'=> $request->clasificacion,
            'titulo'=>$request->titulo,
            'autor'=>$request->autor ?? '',
            'anio'=> $request->anio ?? 0000,
            'editorial'=>$request->editorial ?? '',
            'lugar_publicacion'=>$request->lugar_publicacion ?? '',
            'volumen'=>$request->volumen ?? '',
            'fecha_ingreso'=> $request->fecha_ingreso,
            'situacion' => $request->situacion ?? '',
            'tomo_numero'=>$request->tomo_numero ?? '',
            'paginas'=> $request->paginas ?? 0,
            'serie'=> $request->serie ?? '',
            'isbn_issn'=>$request->isbn_issn ?? '',
            'space'=>$request->isbn_issn ?? '']);


        Informacion::where('clasificacion',$libro)->where('tipo','Libros')->update(
            ['clasificacion'=> $request->clasificacion,
            'obtencion'=>$request->obtencion ?? '',
            'resguardo'=>$request->resguardo ?? '',
            'contenido'=>$request->contenido ?? '',
            'codigo_barras'=>$request->codigo_barras ?? 0,
            'inventario'=>$request->inventario ?? '',
            'fecha_publicacion'=>$request->fecha_publicacion]);


        return redirect()->route('libros.index');

    }
    public function delete($id){
        Libros::where('id',$id)->delete();
        return redirect()->route('libros.index');
    }
    public function buscar(Request $request){
        $request->validate([
            'buscar' => 'required',
            'buscar_por' => 'required',
        ]);
	
        return redirect()->route('libros.resultados',['buscar_por'=>$request->buscar_por,'buscar'=>$request->buscar]);
    }
    public function resultados($buscar_por,$buscar){

        $libros = Libros::where($buscar_por, 'LIKE', '%' . $buscar . '%')->paginate(10);
        $total = count(Libros::where($buscar_por, 'LIKE', '%' . $buscar . '%')->get());
        return view('Libros.buscar', compact('libros','total'));
    }
    public function export()
    {
        return Excel::download(new LibrosExport, 'libros.xlsx');
    }
}

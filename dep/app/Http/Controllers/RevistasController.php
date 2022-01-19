<?php

namespace App\Http\Controllers;

use App\Models\Revistas;
use App\Models\Informacion;
use Illuminate\Http\Request;
use App\Exports\RevistasExport;
use Maatwebsite\Excel\Facades\Excel;

class RevistasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $revista = Revistas::paginate(10);
        $total = count(Revistas::all());
        return view('Revistas.index', compact('revista','total'));
    }
    public function show($id){
        $revista = Revistas::find($id);
        $info = Informacion::where('clasificacion', $revista->clasificacion)->where('tipo','Revistas')->get()[0];
        
        return view('Revistas.show', compact('revista', 'info'));
    }
    public function registro(){

        return view('Revistas.create');
    }
    public function create(Request $request){
       $request->validate([
            'titulo' => 'required',
            'clasificacion' => 'required',
            'fecha_ingreso'=>'required',
        ]);
        $revista = new Revistas();

        $info = new Informacion();

        $revista->titulo = $request->titulo ;
        $revista->autor = $request->autor ?? '';
        $revista->clasificacion = $request->clasificacion;
        $revista->anio = $request->anio ?? 0000;
        $revista->editorial = $request->editorial ?? '';
        $revista->lugar_publicacion = $request->lugar_publicacion ?? '';
        $revista->volumen = $request->volumen ?? '';
        $revista->fecha_ingreso = str_replace(' 00:00:00', '',$request->fecha_ingreso);
        $revista->situacion = $request->situacion ?? '';
        $revista->tomo_numero = $request->tomo_numero ?? '';
        $revista->paginas = $request->paginas ?? 0;
        $revista->serie = $request->serie ?? '';
        $revista->isbn_issn = $request->isbn_issn ?? '';
        $revista->space = $request->space ?? '';
        $revista->space2 = $request->space2 ?? '';

        $info->clasificacion = $request->clasificacion;
        $info->tipo = 'Revistas';
        $info->obtencion = $request->obtencion ?? '';
        $info->resguardo = $request->resguardo ?? '';
        $info->contenido = $request->contenido ?? '';
        $info->codigo_barras = $request->codigo_barras ?? 0;
        $info->inventario = $request->inventario ?? '';
        $info->fecha_publicacion = $request->fecha_publicacion;

        $revista->save();
        $info->save();

        return redirect()->route('revistas.index');

    }
    public function edit($id){
        $revista = Revistas::find($id);
        $info = Informacion::where('clasificacion', $revista->clasificacion)->get()[0];
    
        return view('Revistas.edit', compact('revista', 'info'));
    }
    public function update(Request $request,$revista){
        $request->validate([
            'titulo' => 'required',
            'clasificacion' => 'required',
            'fecha_ingreso'=>'required',
        ]);
        Revistas::where('clasificacion',$revista)->update(
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
            'space'=>$request->space ?? '',
            'space2'=>$request->space2 ?? '',
            ]);

        Informacion::where('clasificacion',$request->clasificacion)->where('tipo','Revistas')->update(
            ['clasificacion'=> $request->clasificacion,
            'obtencion'=>$request->obtencion ?? '',
            'resguardo'=>$request->resguardo ?? '',
            'contenido'=>$request->contenido ?? '',
            'codigo_barras'=>$request->codigo_barras ?? 0,
            'inventario'=>$request->inventario ?? '',
            'fecha_publicacion'=>$request->fecha_publicacion]);


        return redirect()->route('revistas.index');
    }
    public function buscar(Request $request){
        $request->validate([
            'buscar' => 'required',
            'buscar_por' => 'required',
        ]);
        return redirect()->route('revistas.resultados',['buscar_por'=>$request->buscar_por,'buscar'=>$request->buscar]);
    }
    public function resultados($buscar_por,$buscar){
        $revistas = Revistas::where($buscar_por, 'LIKE', '%' . $buscar . '%')->paginate(10);
        $total = count(Revistas::where($buscar_por, 'LIKE', '%' . $buscar . '%')->get());
        return view('Revistas.buscar', compact('revistas','total'));
    }
    public function delete($clasificacion){
        Revistas::where('clasificacion',$clasificacion)->delete();
        return redirect()->route('revistas.index');
    }
    public function export()
    {

        return Excel::download(new RevistasExport, 'revistas.xlsx');
    }
}

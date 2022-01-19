<?php

namespace App\Http\Controllers;

use App\Exports\CuadernosExport;
use App\Models\Cuadernos;
use App\Models\Informacion;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CuadernosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $cuadernos = Cuadernos::paginate(10);
        $total = count(Cuadernos::all());
        return view('Cuadernos.index', compact('cuadernos','total'));
    }

    public function show($id)
    {
        $cuaderno = Cuadernos::find($id);
        $info = Informacion::where('clasificacion', $cuaderno->clasificacion)->get()[0];
        return view('Cuadernos.show', compact('cuaderno', 'info'));
    }
    public function edit($id)
    {
        $cuaderno = Cuadernos::find($id);
        $info = Informacion::where('clasificacion', $cuaderno->clasificacion)->get()[0];
        return view('Cuadernos.edit', compact('cuaderno', 'info'));
    }
    public function registro()
    {
        return view('Cuadernos.create');
    }
    public function create(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'clasificacion' => 'required',
            'fecha_ingreso'=>'required',
        ]);

        $cuaderno = new Cuadernos();

        $info = new Informacion();

        $cuaderno->titulo = $request->titulo ;
        $cuaderno->autor = $request->autor ?? '';
        $cuaderno->clasificacion = $request->clasificacion;
        $cuaderno->anio = $request->anio ?? 0000;
        $cuaderno->editorial = $request->editorial ?? '';
        $cuaderno->lugar_publicacion = $request->lugar_publicacion ?? '';
        $cuaderno->volumen = $request->volumen ?? '';
        $cuaderno->fecha_ingreso = str_replace(' 00:00:00', '',$request->fecha_ingreso);
        $cuaderno->situacion = $request->situacion ?? '';
        $cuaderno->tomo_numero = $request->tomo_numero ?? '';
        $cuaderno->paginas = $request->paginas ?? 0;
        $cuaderno->serie = $request->serie ?? '';
        $cuaderno->isbn_issn = $request->isbn_issn ?? '';

        $info->clasificacion = $request->clasificacion;
        $info->tipo = 'Cuaderno';
        $info->obtencion = $request->obtencion ?? '';
        $info->resguardo = $request->resguardo ?? '';
        $info->contenido = $request->contenido ?? '';
        $info->codigo_barras = $request->codigo_barras ?? 0;
        $info->inventario = $request->inventario ?? '';
        $info->fecha_publicacion = $request->fecha_publicacion;

        $cuaderno->save();
        $info->save();

        return redirect()->route('cuadernos.index');

    }
    public function update(Request $request,$cuaderno)
    {
        $request->validate([
            'titulo' => 'required',
            'clasificacion' => 'required',
            'fecha_ingreso'=>'required',
        ]);
        Cuadernos::where('clasificacion',$cuaderno)->update(
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
            'isbn_issn'=>$request->isbn_issn ?? '']);


        Informacion::where('clasificacion',$cuaderno)->where('tipo','Cuadernos')->update(
            ['clasificacion'=> $request->clasificacion,
            'obtencion'=>$request->obtencion ?? '',
            'resguardo'=>$request->resguardo ?? '',
            'contenido'=>$request->contenido ?? '',
            'codigo_barras'=>$request->codigo_barras ?? 0,
            'inventario'=>$request->inventario ?? '',
            'fecha_publicacion'=>$request->fecha_publicacion]);


        return redirect()->route('cuadernos.index');

    }

    public function delete($id){
        Cuadernos::find($id)->delete();
        return redirect()->route('cuadernos.index');
    }

    public function buscar(Request $request){
        $request->validate([
            'buscar' => 'required',
            'buscar_por' => 'required',
        ]);
        return redirect()->route('cuadernos.resultados',['buscar_por'=>$request->buscar_por,'buscar'=>$request->buscar]);
    }
    public function resultados($buscar_por,$buscar){
        $cuadernos = Cuadernos::where($buscar_por, 'LIKE', '%' . $buscar . '%')->paginate(10);
        $total = count(Cuadernos::where($buscar_por, 'LIKE', '%' . $buscar . '%')->get());
        return view('Cuadernos.buscar', compact('cuadernos','total'));
    }
    public function export()
    {
        return Excel::download(new CuadernosExport, 'cuadernos.xlsx');
    }
}

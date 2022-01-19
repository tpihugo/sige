<?php

namespace App\Http\Controllers;

use App\Models\BibliografiaDigital;
use Illuminate\Http\Request;
use App\Exports\BibliografiaExport;
use Maatwebsite\Excel\Facades\Excel;


class BibliografiaDigitalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $bibliografia = BibliografiaDigital::paginate(10);
        $total = count(BibliografiaDigital::all());
        return view('BibliografiaDigital.index',compact('bibliografia','total'));
    }
    public function show($id){
        $bibliografia = BibliografiaDigital::find($id);
        return view('BibliografiaDigital.show',['bibliografia'=>$bibliografia]);
    }
    public function edit($id){
        $bibliografia = BibliografiaDigital::find($id);
        return view('BibliografiaDigital.edit',compact('bibliografia'));
    }

    public function registro(){
        return view('BibliografiaDigital.create');
    }
    public function create(Request $request){
        $request->validate([
            'titulo'=>'required',
            'autor'=>'required',
            'clasificacion'=>'required',
            'anio'=>'required',
        ]);

        $bibliografia = new BibliografiaDigital();

        $bibliografia->titulo = $request->titulo;
        $bibliografia->autor = $request->autor;
        $bibliografia->clasificacion = $request->clasificacion;
        $bibliografia->anio = $request->anio;

        $bibliografia->save();
        return redirect()->route('bibliografia_digital.index');
    }
    public function update(Request $request){
        $request->validate([
            'titulo'=>'required',
            'clasificacion'=>'required',
        ]);
        BibliografiaDigital::where('clasificacion',$request->clasificacion)->update(
            ['clasificacion'=> $request->clasificacion,
            'titulo'=>$request->titulo,
            'autor'=>$request->autor,
            'anio'=> $request->anio]);

        return redirect()->route('bibliografia_digital.index');
    }

    public function delete($id){
        BibliografiaDigital::find($id)->delete();
        return redirect()->route('bibliografia_digital.index');
    }

    public function buscar(Request $request){
        $request->validate([
            'buscar' => 'required',
            'buscar_por' => 'required',
        ]);

        $bibliografia = BibliografiaDigital::where($request->buscar_por,'LIKE','%'.$request->buscar.'%')->get();
        return redirect()->route('bibliografia_digital.resultados',['buscar_por'=>$request->buscar_por,'buscar'=>$request->buscar]);
    }
    public function resultados($buscar_por,$buscar){
        $bibliografia = BibliografiaDigital::where($buscar_por, 'LIKE', '%' . $buscar . '%')->paginate(10);
        $total = count(BibliografiaDigital::where($buscar_por, 'LIKE', '%' . $buscar . '%')->get());
        return view('BibliografiaDigital.buscar', compact('bibliografia','total'));
    }

    public function export()
    {
        return Excel::download(new BibliografiaExport, 'bibliogarfia.xlsx');
    }

}

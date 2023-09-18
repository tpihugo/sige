<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;
use App\Models\Requisicion;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use requisicion as GlobalRequisicion;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $articulos = Articulo::where('requisicion_id', $id)->where('activo', 1)->get();
        return view('articulos.index', compact('id'))->with('articulos', $articulos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Requisicion $id)
    {
        $requisicion = $id->id;
        return view('articulos.create', compact('requisicion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->requisicion_id;
        $temp = $request->except(['_token', 'requisicion_id']);
        $limit = count($temp['status']);
        $this->validate($request, [
            'codigo.0'  => 'required',
            'descripcion.0'  => 'required',
            'cantidad.0'  => 'required',
            'observacion.0' => 'required',
        ]);
        for ($i = 0; $i < $limit; $i++) {
            $articulos = new Articulo();
            $articulos->codigo = $temp['codigo'][$i];
            $articulos->cantidad = $temp['cantidad'][$i];
            $articulos->descripcion = $temp['descripcion'][$i];
            $articulos->observacion = $temp['observacion'][$i];
            $articulos->status = $temp['status'][$i];
            $articulos->requisicion_id = $id;
            $articulos->save();
        }
        return redirect()->route('requisiciones.index');
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
        $articulo = Articulo::find($id);
        return view('articulos.edit')->with('articulo', $articulo);
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
        $articulo = Articulo::find($id);

        $articulo->codigo = $request->get('codigo');
        $articulo->cantidad = $request->get('cantidad');
        $articulo->descripcion = $request->get('descripcion');
        $articulo->observacion = $request->get('observacion');
        $articulo->status = $request->get('status');
        $articulo->requisicion_id = $request->get('requisicion_id');
        //dd($articulo);
        $articulo->save();


        return redirect()->route('requisicion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articulo = Articulo::find($id);
        $articulo->activo = 0;

        return redirect()->route('requisicion.index');
    }

    public function buscador_articulos(Request $request)
    {

        $articulos = Articulo::join('requisiciones', 'articulos.requisicion_id', '=', 'requisiciones.id')
            ->where('articulos.descripcion', 'like', '%' . $request->articulo . '%')->orderBy('articulos.requisicion_id','desc')->get();

        return view('requisiciones.tabla', compact('articulos'))->render();
    }
}

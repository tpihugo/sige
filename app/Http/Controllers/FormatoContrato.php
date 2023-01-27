<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VsPrestamo;
use App\Models\EquipoPorPrestamo;
use Carbon\Carbon;

class FormatoContrato extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function imprimirContrato($prestamo_id)
    {
        $contador = 1;
        $prestamo = VsPrestamo::where('id', '=', $prestamo_id)->first();
        $equiposPorPrestamo = EquipoPorPrestamo::where('id_prestamo','=', $prestamo_id)->get();
        $fechaProxima = Carbon::now()->addMonths(5);

       // dd($fechaDevolucion);

       $contador_consulta = EquipoPorPrestamo::where('id_prestamo','=', $prestamo_id)->count();
        $pdf = \PDF::loadView('contrato.pdf', compact('prestamo','equiposPorPrestamo', 'contador' , 'fechaProxima','contador_consulta'));
        
        return $pdf->stream('formatoContrato.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
}

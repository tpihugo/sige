<?php

namespace App\Http\Controllers;

use App\Models\Prestamos;
use Illuminate\Http\Request;

class PrestamosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $prestamos = Prestamos::paginate(10);
        $no_entregados = count(Prestamos::where('status', '=', 'Abierto')->get());
        $entregados = count(Prestamos::where('status', '=', 'Cerrado')->get());
        return view('Prestamos.index', compact('prestamos', 'entregados', 'no_entregados'));
    }
    public function registro($tipo, $clasificacion)
    {
        return view('Prestamos.create', compact('tipo', 'clasificacion'));
    }
    public function create(Request $request)
    {
        $request->validate([
            'fecha_prestamo' => 'required',
            'nombre' => 'required',
            'email' => 'required',
        ]);
        $prestamo = new Prestamos();
        $prestamo->clasificacion = $request->calsificacion;
        $prestamo->tipo = $request->tipo;
        $prestamo->fecha_prestamo = $request->fecha_prestamo;
        $prestamo->prestado_A = $request->nombre;
        $prestamo->correo = $request->email;
        $prestamo->save();
        return redirect()->route('prestamos.index');
    }

    public function cerrar_prestamo($clasificaicon, $tipo, $fecha, $prestado_A)
    {
        Prestamos::where('clasificacion', $clasificaicon)->where('tipo', $tipo)->where('fecha_prestamo', $fecha)->where('prestado_A', $prestado_A)->update([
            'status' => 'Cerrado',
            'fecha_entrega' => now(),
        ]);
        return redirect()->route('prestamos.index');
    }
    public function search(Request $request)
    {
        $request->validate([
            'buscar' => 'required',
            'buscar_por' => 'required',
        ]);
        $prestamos = Prestamos::where($request->buscar_por, 'LIKE', '%' . $request->buscar . '%')->paginate(5);
        return redirect()->route('prestamos.resultados',['buscar_por'=>$request->buscar_por,'buscar'=>$request->buscar]);

    }
    public function resultados($buscar_por,$buscar){
        $prestamos = Prestamos::where($buscar_por, 'LIKE', '%' . $buscar . '%')->paginate(5);
        $total = count(Prestamos::where($buscar_por, 'LIKE', '%' . $buscar . '%')->get());
	$pagina = count($prestamos->all());
	$total = $total . ",".$pagina;
        return view('Prestamos.buscar', compact('prestamos','total'));
    }}

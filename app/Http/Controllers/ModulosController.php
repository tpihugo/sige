<?php

namespace App\Http\Controllers;

use App\Models\EnlaceModulos;
use App\Models\Modulos;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ModulosController extends Controller
{
    public function __construct()
    {
        $this->middleware('is-admin');
    }
    public function index()
    {
        $modulos = Modulos::where('activo', 1)->get();
        return view('modulos.index', compact('modulos'));
    }
    public function show($id)
    {
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'nombre_permiso' => 'required',
        ]);
        $modulo = Modulos::create([
            'nombre' => \Str::upper($request->nombre),
            'icono' => $request->icono,
            'color' => $request->color,
            'nombre_permiso' => $request->nombre_permiso,
        ]);
        return redirect()->route('modulos.index');
    }
    public function edit(Modulos $modulo)
    {
        $enlaces = EnlaceModulos::where('modulo_id', $modulo->id)
            ->where('activo', 1)
            ->get();
        return view('modulos.edit', compact('modulo', 'enlaces'));
    }
    public function update(Request $request, Modulos $modulo)
    {
        $modulo->update([
            'nombre' => $request->nombre,
            'icono' => $request->icono,
            'color' => $request->color,
            'nombre_permiso' => $request->nombre_permiso,
            'orden' => $request->orden,
        ]);

        if (isset($request->enlaces) && isset($request->titulo)) {
            $enlaces = array_combine($request->enlaces, $request->titulo);
            $parametros = $request->parametros;
            $cont = 0;
            foreach ($enlaces as $key => $value) {
                EnlaceModulos::updateOrCreate(
                    ['modulo_id' => $modulo->id, 'enlace' => $key],
                    [
                        'modulo_id' => $modulo->id,
                        'enlace' => $key,
                        'titulo' => $value,
                        'parametro' => $parametros[$cont],
                        'estilos' => isset($request->estilos[$cont]) ? $request->estilos[$cont] : 'btn btn-outline-success  btn-sm m-1',
                        'activo' => 1,
                    ],
                );
                $cont += 1;
            }
        }

        return redirect()->route('modulos.index');
    }
    public function eliminar_enlace(Request $request)
    {
        $enlace = EnlaceModulos::where('id', $request->id)->first();
        if ($enlace->delete()) {
            Alert::success('SUCCESS', 'SE HA DESACTIVADO EL ENALCE');
            return 'Se elimino correctamente';
        }
        Alert::danger('DANGER', 'OCURRIO UN ERROR AL DESACTIVAR EL ENALCE');
        return 'Hubo un error al eliminar';
    }

    public function destroy($id)
    {
        $modulo = Modulos::find($id);
        $modulo->activo = 0;
        if ($modulo->update()) {
            Alert::success('SUCCESS', 'SE HA DESACTIVADO EL ENALCE');
            return redirect()->route('modulos.index');
        }
        Alert::danger('DANGER', 'OCURRIO UN ERROR AL DESACTIVAR EL ENALCE');
        return redirect()->route('modulos.index');
    }
}

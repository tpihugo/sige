<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.index')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'rol' => 'unique:roles,name'
        ];
        $message = [
            'rol.unique' => 'El rol ya existe'
        ];

        $validator = Validator::make($request->all(),$rules,$message);
        if ($validator->fails()) {
            return view('roles.create')->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            $rol = Role::create($request->all());
            $roles = Role::all();
            DB::commit();
            return view('roles.index')
                ->withSuccess("Rol guardado con éxito.")
                ->with('roles', $roles);
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
            return view('roles.create')->withErrors("Error al guardar el Rol.");
        }
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
        $role = Role::findOrFail($id);

        if (! $role) {
            return view('roles.index')->withErrors("El no existe.");
        }

        return view('roles.edit')->with('rol', $role);
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
        $rules = [
            'rol' => 'unique:roles,name'
        ];
        $message = [
            'rol.unique' => 'El rol ya existe'
        ];

        $validator = Validator::make($request->all(),$rules,$message);
        if ($validator->fails()) {
            return view('roles.create')->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            $role = new Role();
            $role->fill($request->all());
            $role->save();
            $roles = Role::all();
            DB::commit();
            return view('roles.index')
                ->withSuccess("Rol guardado con éxito.")
                ->with('roles', $roles);
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
            return view('roles.create')->withErrors("Error al guardar el Rol.");
        }
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

    public function relacionar()
    {
    }
}

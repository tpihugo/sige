<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::orderBy('name')->get();
        return view('usuarios.index')->with('usuarios',$usuarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $retorno = array('Error'    => array(),
                         'Success'  => array());

        # Validar que las contraseñas sean las mimsas
        if( $request['password'] != $request['password_confirmation'])
            $retorno['Error'][] = "La contraseña y la confirmacion de contraseña no son iguales.";

        # Validar que el usuario no exita
        $existe = User::where('email',$request['email'])->get();
        if(count($existe) > 0)
            $retorno['Error'][] = "El email ya está previamente registrado.";

        if( !count($retorno['Error']) > 0){
            $nuevo = User::create([
                                    'name' => $request['name'],
                                    'email' => $request['email'],
                                    'password' => Hash::make($request['password']),
                                ]);

            $retorno['Success'][] = "Usuario {$request['email']} registrado";
        }

        $usuarios = User::orderBy('name')->get();

        return view('usuarios.index')->with('usuarios', $usuarios)
                                    ->with('retorno', $retorno);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::where('id', $id)->get();
        return view('usuarios.edit')->with('usuario', $usuario);
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
        $retorno = array('Error'    => array(),
                         'Success'  => array());

        # Validar que las contraseñas sean las mimsas
        if( $request['password'] != $request['password_confirmation'])
            $retorno['Error'][] = "La contraseña y la confirmacion de contraseña no son iguales.";

        if( !count($retorno['Error']) > 0){
            $nuevo = User::where('id', $id)->update([
                                                        'email'     => $request['email'],
                                                        'name'      => $request['name'],
                                                        'password'  => Hash::make($request['password']),
                                                    ]);

            $retorno['Success'][] = "Usuario {$request['email']} Actualizado";
        }

        $usuarios = User::orderBy('name')->get();

        return view('usuarios.index')->with('usuarios', $usuarios)
                                    ->with('retorno', $retorno);
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

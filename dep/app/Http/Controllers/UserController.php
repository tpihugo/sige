<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function registro()
    {
        return view('Users.registro');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'tipo' => 'required',
        ]);
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->rol = $request->tipo;
        $usuario->save();
        return redirect()->route('home');
    }
    public function index()
    {
        $usuarios = User::paginate(15);
        return view('Users.index', compact('usuarios'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
        ]);
        $usuarios = User::where('name', 'LIKE', '%' . $request->nombre . '%')->get();
        return view('Users.plantilla', compact('usuarios'));
    }
    public function perfil()
    {
        $id = Auth::user()->id;

        $usuario = User::find($id);
        return view("Users.perfil", compact('usuario'));
    }
    public function password_change(Request $request)
    {
        $rules = [
            'password' => 'required|confirmed|min:6|max:18',
        ];

        $messages = [
            'password.required' => 'El campo es requerido',
            'password.confirmed' => 'Los passwords no coinciden',
            'password.min' => 'El mínimo permitido son 6 caracteres',
            'password.max' => 'El máximo permitido son 18 caracteres',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            return redirect()->route('usuario.perfil')->withErrors($validator);
        }
        else{
            $id = Auth::user()->id;
            User::where('id', $id)->update([
                'password' => Hash::make($request->password)
            ]);
                return redirect()->route('usuario.perfil')->with('status', 'Password cambiado con éxito');
        }


        //return redirect()->back()->withSuccess('Password actualizado');
    }
}

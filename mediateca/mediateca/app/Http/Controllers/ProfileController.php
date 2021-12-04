<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $profile = User::all();
        return view('myprofile')->with('users',$profile);
    }


     public function usuarios()
    {
        $profile = User::all();
        return view('./usuarios.index')->with('users',$profile);

    }

    public function ProfileController (){
        $profile = User::all();
        return view('myprofile')->with('users',$profile);
    }

    public function update (Request $request){
        $profile = User::find(Auth::user()->id);

        if($request->get('pwd') == null || $request->get('rpwd') == null ){
            $profile->name = $request->get('name');
            $profile->email = $request->get('email');
        }else{
            if($request->get('pwd') == $request->get('rpwd')){
                $profile->password = bcrypt($request->get('pwd'));
            }
        }

        $profile->save();
        return redirect('./myprofile');
    }

    public function save (Request $request){
      $profile = User::find(Auth::user()->id);

      if($request->hasfile('file')){
            $file=$request->file('file');
            $nombre=Auth::user()->id.".".$file->getClientOriginalExtension();
            $file->move(public_path().'/img/profiles/', $nombre);
            $profile->profile_photo_path = $nombre;
        }
        $profile->save();
        return redirect('./myprofile');
    }

    public function destroy($id)
    {
        $profile = User::find($id);
        $profile->delete();
        return redirect('./usuarios');

    }

   
}

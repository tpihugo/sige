<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $materiales = Material::all();
        return view('material.index')->with('materials',$materiales);
    }
}


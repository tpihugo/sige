<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $materiales = Material::orderBy('id', 'desc') ->get();
        return view('index')->with('materials',$materiales);
    }
}

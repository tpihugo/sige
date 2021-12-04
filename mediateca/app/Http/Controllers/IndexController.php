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
    public function __construct()
    {
        $this->middleware('auth');
    }

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

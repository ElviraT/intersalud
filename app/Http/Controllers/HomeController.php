<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UsuarioM;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:home')->only('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $foto = UsuarioM::where('id_Medico',auth()->user()->id_usuario)->first();
        return view('home')->with(compact('foto'));
    }

    
}

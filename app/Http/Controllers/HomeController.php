<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UsuarioM;
use App\Model\ControlHM;
use DateTime;


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
        $cita = ControlHM::where('Paciente_id',auth()->user()->id_usuarioP)->where('cerrado', 0)->first();
        if($cita){
            $fecha1= new DateTime(date('Y-m-d H:i'));
            $fecha2= new DateTime($cita->Citas->start);
            $diff = $fecha1->diff($fecha2);
        }else{
            $diff= [];
        }

        return view('home')->with(compact('foto','diff'));
    }

    
}

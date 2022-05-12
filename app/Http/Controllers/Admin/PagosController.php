<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\Request;
use App\Model\UsuarioP;
use DB;

class PagosController extends Controller
{
	public function __construct()
    {
      $this->middleware('can:pago')->only('index');
      $this->middleware('can:pago.add')->only('add');
      $this->middleware('can:pago.edit')->only('edit');
      $this->middleware('can:pago.destroy')->only('destroy');
    }
    public function index()
    {
    	if (auth()->user()->id_usuarioP > 0) {
    		$pacientes=Collection::make(UsuarioP::select(['id_Paciente',DB::raw('CONCAT(Nombres_Paciente, " ", Apellidos_Paciente) AS Nombre')])->where('id_Paciente',auth()->user()->id_usuarioP)->where('Status_id',1)->orderBy('Nombres_Paciente')->pluck("Nombre", "id_Paciente"));
    	}else{
    		$pacientes=Collection::make(UsuarioP::select(['id_Paciente',DB::raw('CONCAT(Nombres_Paciente, " ", Apellidos_Paciente) AS Nombre')])->where('Status_id',1)->orderBy('Nombres_Paciente')->pluck("Nombre", "id_Paciente"));
    	}
    	return view('pagos.index')->with(compact('pacientes'));
    }
}

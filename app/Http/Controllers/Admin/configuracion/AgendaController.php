<?php

namespace App\Http\Controllers\Admin\configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Agenda;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
    	return view('admin.configuracion.agendas.index');
    }
}

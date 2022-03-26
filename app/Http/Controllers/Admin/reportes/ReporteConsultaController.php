<?php

namespace App\Http\Controllers\Admin\reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ControlHM;

class ReporteConsultaController extends Controller
{
   public function index()
    {
    	$reportes = ControlHM::all();
    	return view('admin.reportes.index')->with(compact('reportes'));
    }
}

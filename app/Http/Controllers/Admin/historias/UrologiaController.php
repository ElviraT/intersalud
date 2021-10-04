<?php

namespace App\Http\Controllers\Admin\historias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UrologiaController extends Controller
{
    public function index()
    {
    	return view('admin.historias.urologia.index');
    }

    public function create()
    {
    	$sexo=['1'=> 'Mujer','2'=> 'Hombre','3'=> 'Otro'];
    	return view('admin.historias.urologia.create', ['sexo'=> $sexo]); 
    }
}

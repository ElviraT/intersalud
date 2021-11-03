<?php

namespace App\Http\Controllers\Admin\historias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UrologiaController extends Controller
{
     public function __construct()
    {
      $this->middleware('can:urologia')->only('index');
      $this->middleware('can:urologia.create')->only('create');
      //$this->middleware('can:civil.edit')->only('edit');
      //$this->middleware('can:civil.destroy')->only('destroy');
    }
    public function index()
    {
    	return view('admin.historias.urologia.index');
    }

    public function create()
    {
    	$sexo=['1'=> 'Mujer','2'=> 'Hombre','3'=> 'Otro'];
    	$detalle=['1'=> 'detalle1','2'=> 'detalle2','3'=> 'detalle3'];
    	return view('admin.historias.urologia.create', ['sexo'=> $sexo, 'detalle'=> $detalle]); 
    }
}

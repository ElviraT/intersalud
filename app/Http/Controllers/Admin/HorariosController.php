<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Horario;
use Flash;

class HorariosController extends Controller
{
	 public function __construct()
    {
      $this->middleware('can:horario')->only('index');
      $this->middleware('can:horario.add')->only('add');
      $this->middleware('can:horario.edit')->only('edit');
      $this->middleware('can:horario.destroy')->only('destroy');
    }
    public function index(Horario $model)
    {
    	return view('admin.horarios.index', ['horarios' => $model->all()]);
    }

    public function create()
    {
    	return view('admin.horarios.create');
    }
}

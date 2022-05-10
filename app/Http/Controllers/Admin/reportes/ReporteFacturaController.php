<?php

namespace App\Http\Controllers\Admin\reportes;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\Request;
use App\Model\UsuarioM;
use App\Model\Factura;
use DB;

class ReporteFacturaController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:facturaH')->only('index');
    }

    public function index(Request $request)
    {
    	$method = $request->method();
        $response = $request->all();
        $factura = (new Factura)->newQuery();

        if (!$_GET) {
            $id_medico = NULL;
            $fecha = NULL;
          } 
        if ($request->isMethod('post')) {
            $id_medico = $request->input('id_medico');
            $fecha = $request->input('fecha');
        }
        if ($id_medico != NULL) {
            $factura->where('Medico_id', $id_medico)->get();
        }
        if ($fecha != NULL) {
            $factura->whereDate('Fecha', $fecha)->get();
        }
    	$medico=Collection::make(UsuarioM::select(['id_Medico',DB::raw('CONCAT(Nombres_Medico, " ", Apellidos_Medicos) AS Nombre')])->where('Status_Medico_id',1)->orderBy('Nombres_Medico')->pluck("Nombre", "id_Medico"));

    	$factura= $factura->get();
    	return view('admin.reportes.factura.index')->with(compact('factura','medico','id_medico','fecha'));
    }
}

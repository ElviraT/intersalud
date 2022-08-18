<?php

namespace App\Http\Controllers\Admin\reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Factura;
use DB;

class ReporteCxPController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:cxp')->only('index');
    }

    public function index(Request $request)
    {
		$cxps= Factura::select([
				  DB::raw('CONCAT(usuarios_medicos.Nombres_Medico, " ", usuarios_medicos.Apellidos_Medicos) AS nombre'), 
				  DB::raw('SUM(factura_detalle.Costo_Servicio) AS total')])
		        ->join('factura_detalle', 'factura_detalle.Factura_id', 'facturas.id_Factura')
		        ->join('usuarios_medicos', 'usuarios_medicos.id_Medico', 'facturas.Medico_id')
		        ->groupBy('usuarios_medicos.Nombres_Medico','usuarios_medicos.Apellidos_Medicos')
		        ->distinct('usuarios_medicos.Nombres_Medico')
		        ->newQuery();
		        
		 $cxps = $cxps->get();

    	return view('admin.reportes.cxp.index')->with(compact('cxps'));
    }
}

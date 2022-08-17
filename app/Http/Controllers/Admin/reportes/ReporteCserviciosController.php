<?php

namespace App\Http\Controllers\Admin\reportes;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\Request;
use App\Model\UsuarioM;
use App\Model\StatusF;
use App\Model\Servicio;
use App\Model\Factura;
use DB;

class ReporteCserviciosController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:cservicios')->only('index');
    }

    public function index(Request $request)
    {
    	$method = $request->method();
        $response = $request->all();

        if (!$_GET) {
            $id_status = NULL;
            $id_servicio = NULL;
            $fecha = NULL;
          } 
        if ($request->isMethod('post')) {
            $fecha = $request->input('fecha');
            $id_status = $request->input('id_status');
            $id_servicio = $request->input('id_servicio');
        }

       /* SELECT Servicio_id, count(Cantidad), SUM(Costo_Servicio), Fecha FROM factura_detalle JOIN facturas ON Factura_id = id_Factura GROUP BY Servicio_id, Fecha;*/

        $cservicios= Factura::select('servicios.Servicio','facturas.Fecha', DB::raw('COUNT(factura_detalle.Cantidad) AS cantidad, SUM(factura_detalle.Costo_Servicio) AS costo'))
		        ->join('factura_detalle', 'factura_detalle.Factura_id', 'facturas.id_Factura')
		        ->join('servicios', 'servicios.id_Servicio', 'factura_detalle.Servicio_id')
		        ->groupBy('servicios.Servicio','facturas.Fecha')
		        ->newQuery();
            

        if ($fecha != NULL) {
            $cservicios->whereDate('Fecha', $fecha)->get();
        }
        if ($id_status != NULL) {
            $cservicios->where('Status_Factura_id', $id_status)->get();
        }
        if ($id_servicio != NULL) {
            $cservicios->where('servicios.id_Servicio', $id_servicio)->get();
        }

    	$status=Collection::make(StatusF::select(['id_Status_Factura','Status_Factura'])->orderBy('Status_Factura')->get())->pluck("Status_Factura", "id_Status_Factura");

    	$servicio=Collection::make(Servicio::select(['id_Servicio','Servicio'])->orderBy('Servicio')->get())->pluck("Servicio", "id_Servicio");
    	$cservicios= $cservicios->get();
    	return view('admin.reportes.consulta_servicios.index')->with(compact('cservicios','fecha','id_status', 'status','id_servicio','servicio'));
    }
}

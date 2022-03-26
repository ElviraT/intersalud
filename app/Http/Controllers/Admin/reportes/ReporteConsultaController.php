<?php

namespace App\Http\Controllers\Admin\reportes;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\Request;
use App\Model\ControlHM;
use App\Model\UsuarioM;
use App\Model\Especialidad;
use App\Model\Servicio;
use DB;

class ReporteConsultaController extends Controller
{
   public function index(Request $request)
    {
    	$method = $request->method();
        $response = $request->all();
        $reporte = (new ControlHM)->newQuery();

        if (!$_GET) {
            $id_medico = NULL;
            $id_especialidad = NULL;
            $id_servicio = NULL;
            $fecha = NULL;
            $id_cerrado = NULL;
          } 
        if ($request->isMethod('post')) {
            $id_medico = $request->input('id_medico'); 
            $id_especialidad = $request->input('id_especialidad');      
            $id_servicio = $request->input('id_servicio');
            $fecha = $request->input('fecha');
            $id_cerrado = $request->input('cerrado');
        }
        
        if ($id_medico != NULL) {
            $reporte->where('Medico_id', $id_medico)->get();
        }
        if ($id_especialidad != NULL) {
            $reporte->where('Especialidad_Medica_id', $id_especialidad)->get();
        }

        if ($id_servicio != NULL) {
            $reporte->where('id_servicio', $id_servicio)->get();
        }

        if ($fecha != NULL) {
            $reporte->whereDate('Fecha', $fecha)->get();
        }

        if ($id_cerrado != NULL) {
            $reporte->where('cerrado', $id_cerrado)->get();
        }

    	$medico=Collection::make(UsuarioM::select(['id_Medico',DB::raw('CONCAT(Nombres_Medico, " ", Apellidos_Medicos) AS Nombre')])->where('Status_Medico_id',1)->orderBy('Nombres_Medico')->pluck("Nombre", "id_Medico"));

        $especialidad = Collection::make(Especialidad::select(['id_Especialidad_Medica','Espacialiadad_Medica'])->orderBy('Espacialiadad_Medica')->pluck("Espacialiadad_Medica", "id_Especialidad_Medica"));

        $servicio = Collection::make(Servicio::select(['id_Servicio','Servicio'])->orderBy('Servicio')->pluck("Servicio", "id_Servicio")); 

    	$reportes = $reporte->get();
    	return view('admin.reportes.index')->with(compact('reportes','medico','especialidad','servicio','id_medico','id_especialidad','id_servicio','fecha','id_cerrado'));
    }
}

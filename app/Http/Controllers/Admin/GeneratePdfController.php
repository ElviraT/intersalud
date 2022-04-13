<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\Request;
use App\Model\ControlHM;
use App\Model\Factura;
use App\Model\FacturaDetalle;
use App\Model\TipoPago;
use PDF;
use DB;

class GeneratePdfController extends Controller
{
    public function pdfForm($id)
    {
    	$dataf = ControlHM::where('id_Control_Historia_Medica', $id)->first();
    	//dd($dataf);
        return view('admin.factura.pdf_form')->with(compact('dataf'));
    }

    public function add(Request $request)
    {
    	DB::beginTransaction();
    	try {

    		$factura = new Factura();
            $factura->Cita_Consulta_id = $request['Cita_Consulta_id'];
            $factura->Fecha = $request['Fecha'];
            $factura->Datos_SENIAT_id = $request['Datos_SENIAT_id'];
            $factura->Pacientes_id =$request['Pacientes_id'];
            $factura->Status_Factura_id = $request['Status_Factura_id'];
            $factura->Relacion_Medico = $request['Relacion_Medico'];
            $factura->Medico_id = $request['Medico_id'];
            $factura->Asistente_id = $request['Asistente_id'];
            $factura->Nombre = $request['Nombre'];
            $factura->Apellido = $request['Apellido'];
            $factura->CIDNI = $request['CIDNI'];
            $factura->Status_no_paciente = $request['Status_no_paciente'];
            $factura->save(); 

            $facturaD = new FacturaDetalle();
            $facturaD->Factura_id = $factura['id'];
            $facturaD->Servicio_id = $request['Servicio_id'];
            $facturaD->Cantidad = $request['Cantidad'];
            $facturaD->Costo_Servicio = $request['Costo_Servicio'];
            $facturaD->moneda = $request['moneda'];
            $facturaD->iva = $request['iva'];
            $facturaD->impuesto = $request['impuesto'];
            $facturaD->Status_Factura_id =$request['Status_Factura_id'];
            $facturaD->save(); 
    			
		 	DB::commit();
      	}catch (Exception $e) {
        	DB::rollback();
			
		}
		return redirect()->route('factura.pago', $factura['id']);	
    }

    public function pago($Factura_id)
    {
    	$tipoP=Collection::make(TipoPago::select(['id_Tipos_Pago','Tipo_Pago'])->orderBy('Tipo_Pago')->pluck("Tipo_Pago", "id_Tipos_Pago"));
		return view('admin.factura.pago')->with(compact('Factura_id', 'tipoP'));
    }
 
    public function pdfDownload(Request $request){
      
         $data = 
         [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
         ];
       $pdf = PDF::loadView('admin.factura.pdf_download', $data);
   
       return $pdf->download('Factura.pdf');
    }
}

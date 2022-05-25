<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\Request;
use App\Model\ControlHM;
use App\Model\Factura;
use App\Model\FacturaDetalle;
use App\Model\ServicioA;
use App\Model\Status;
use App\Model\StatusF;
use App\Model\UsuarioP;
use App\Model\FacturaBs;
use App\Model\FacturaUSD;
use App\Model\PagoConfirmar;
use DB;

class ConfirmarPagoController extends Controller
{
     public function __construct()
    {
      $this->middleware('can:confirmar_pago')->only('index');
      $this->middleware('can:confirmar_pago.add')->only('add');;
    }
 	
 	public function index(Request $request)
    {
    $method = $request->method();
        $response = $request->all();
        if (!$_GET) {
            $fecha = date('Y-m-d');
            $paciente = NULL;
            $dataf= null;
            $pago= null;
            $servicios= null;
          } 
        if ($request->isMethod('post')) {
            $dataf = (new ControlHM)->newQuery();
            $fecha = $request->input('fecha');
            $paciente = $request->input('paciente');
        }
        
        if ($paciente != NULL && $fecha != NULL) {
           $dataf = $dataf->where('Paciente_id', $paciente)->whereDate('Fecha', $fecha)->where('cerrado', 1)->first();
           
           $servicios= ServicioA::select('servicios.id_servicio','servicios.Servicio','servicios.Costos','servicios.simbolo')
		        ->join('servicios', 'servicios_adicionales.id_servicio', 'servicios.id_Servicio')
		        ->join('citas_consultas', 'servicios_adicionales.Cita_Consulta_id','citas_consultas.id_Cita_Consulta')                                
		        ->join('control_historia_medicas', 'citas_consultas.id_Cita_Consulta','control_historia_medicas.Cita_Consulta_id')                                
		        ->where('control_historia_medicas.cerrado', 1)
		        ->where('citas_consultas.Paciente_id', $paciente)
		        ->whereDate('citas_consultas.start', $fecha)
		        ->groupBy('servicios.id_servicio','servicios.Servicio','servicios.Costos','servicios.simbolo')
		        ->get();

            $pago= PagoConfirmar::where('Paciente_id', $paciente)->where('confirmado', 0)->first();
          
        }  
        if(auth()->user()->id_usuario > 0 ){ 
	        $pacientes= UsuarioP::select(['id_Paciente AS id', DB::raw('CONCAT(Nombres_Paciente, " ", Apellidos_Paciente) AS nombre')])
	          ->leftJoin('control_historia_medicas', 'id_Paciente', 'Paciente_id')
	          ->where('Medico_id', auth()->user()->id_usuario)
	          ->distinct('id')
	          ->orderBy('nombre')
	          ->get();

        }elseif(auth()->user()->id_usuarioA > 0 ){
	        $asistente = UsuarioA::where('id_asistente',auth()->user()->id_usuarioA)->first();
	        $pacientes= UsuarioP::select(['id_Paciente AS id', DB::raw('CONCAT(Nombres_Paciente, " ", Apellidos_Paciente) AS nombre')])
		          ->leftJoin('control_historia_medicas', 'id_Paciente', 'Paciente_id')
		          ->where('Medico_id', $asistente->id_Medico)
		          ->distinct('id')
		          ->orderBy('nombre')
		          ->get();
        }else{
        $pacientes=Collection::make(UsuarioP::select(['id_Paciente',DB::raw('CONCAT(Nombres_Paciente, " ", Apellidos_Paciente) AS Nombre')])->where('Status_id',1)->orderBy('Nombres_Paciente')->pluck("Nombre", "id_Paciente"));
        }
        $status=Collection::make(Status::select(['id_Status','Status'])->orderBy('Status')->get())->pluck("Status", "id_Status");
        $statusf=Collection::make(StatusF::select(['id_Status_Factura','Status_Factura'])->orderBy('Status_Factura')->get())->pluck("Status_Factura", "id_Status_Factura");

        return view('admin.confirmar.index')->with(compact('pacientes','fecha','paciente', 'dataf','servicios','status','statusf','pago'));
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
            $factura->Status_Factura_id = $request['statusF'];
            $factura->Relacion_Medico = $request['Relacion_Medico'];
            $factura->Medico_id = $request['Medico_id'];
            $factura->Asistente_id = $request['Asistente_id'];
            $factura->Nombre = $request['Nombre'];
            $factura->Apellido = $request['Apellido'];
            $factura->CIDNI = $request['CIDNI'];
            $factura->Status_no_paciente = $request['Status_no_paciente'];
            $factura->moneda_cancela = $request['monedaf'];
            $factura->save(); 

            foreach ($request['Servicio'] as $key=>$value) {
              $facturaD = new FacturaDetalle();
              $facturaD->Factura_id = $factura['id'];
              $facturaD->Servicio_id = $key;
              $facturaD->Cantidad = $request['Cantidad'];
              $facturaD->Costo_Servicio = $value;
              $facturaD->moneda = $request['moneda'];
              $facturaD->iva = $request['iva'];
              $facturaD->Status_Factura_id =$request['statusF'];
              $facturaD->save(); 
              
            }
            switch ($request['monedaf']) {
              case 'Bs':
                  $facturaBs = new FacturaBs();
                  $facturaBs->Factura_id = $factura['id'];
                  $facturaBs->Status_Tasa_id = 1;
                  $facturaBs->Status_Pago = $request['statusP'];
                  $facturaBs->Cuenta_Bancaria_BS_id = $request['cbsf'];
                  $facturaBs->Total_Cancelado = $request['totalf'];
                  $facturaBs->Referencia_Bancaria =$request['reff'];
                  $facturaBs->Tipo_Pago_id =$request['tpagof'];
                  $facturaBs->save(); 
                break;
             /* case 'USD':
                // code...
                break;*/
              default:
                  $facturaUSD = new FacturaUSD();
                  $facturaUSD->Factura_id = $factura['id'];
                  $facturaUSD->Status_Tasa_id = 1;
                  $facturaUSD->Status_Pago = $request['statusP'];
                  $facturaUSD->Cuenta_USD_id = $request['cusdf'];
                  $facturaUSD->Total_Cancelado = $request['totalf'];
                  $facturaUSD->Referencia =$request['reff'];
                  $facturaUSD->Tipo_Pago_id =$request['tpagof'];
    			
                  $facturaUSD->impuesto =$request['impuestof'];
                  $facturaUSD->save();
                break;
            }
            ControlHM::where('Cita_Consulta_id', $request['Cita_Consulta_id'])->update([
                    'factura_generada' => 1,
                ]);
            PagoConfirmar::where('id_pago', $request['id_pago'])->update([
                    'confirmado' => 1,
                ]);

		 	DB::commit();
      $info = 'Pago confirmado correctamente';
      	}catch (Exception $e) {
        	DB::rollback();
			$info= 'Ocurrio un error intente de nuevo';
		}
    $resp= [$info, $factura['id']];
    return response()->json($resp);
		
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\Request;
use App\Model\ControlHM;
use App\Model\Factura;
use App\Model\FacturaDetalle;
use App\Model\TipoPago;
use App\Model\UsuarioP;
use App\Model\UsuarioM;
use App\Model\ServicioA;
use App\Model\Status;
use App\Model\CuentaBanco;
use App\Model\CuentaUSD;
use App\Model\Billetera;
use App\Model\TipoCambio;
use App\Model\FacturaBs;
use App\Model\FacturaUSD;
use PDF;
use DB;

class GeneratePdfController extends Controller
{
  public function index2()
  {
    $factura= Factura::where('id_Factura', '19')->first();
    switch ($factura['moneda_cancela']) {
      case 'Bs':
        $factura_moneda = FacturaBs::where('Factura_Id', '19')->first();
        break;
      
      default:
        $factura_moneda = FacturaUSD::where('Factura_Id', '19')->first();
        break;
    }
    return view('admin.factura.factura_ver')->with(compact('factura','factura_moneda'));
  }
    public function index(Request $request)
    {
        $method = $request->method();
        $response = $request->all();
        if (!$_GET) {
            $fecha = date('Y-m-d');
            $paciente = NULL;
            $id_medico = NULL;
            $dataf= null;
            $servicios= null;
          } 
        if ($request->isMethod('post')) {
            $dataf = (new ControlHM)->newQuery();
            $fecha = $request->input('fecha');
            $paciente = $request->input('paciente');
            $id_medico = $request->input('id_medico');
        }
        
        if ($paciente != NULL && $fecha != NULL) {
           $dataf = $dataf->where('Paciente_id', $paciente)->whereDate('Fecha', $fecha)->where('cerrado', 1)->where('factura_generada', 0)->first();
           
           $servicios= ServicioA::select('servicios.id_servicio','servicios.Servicio','servicios.Costos','servicios.simbolo')
                                ->join('servicios', 'servicios_adicionales.id_servicio', 'servicios.id_Servicio')
                                ->join('citas_consultas', 'servicios_adicionales.Cita_Consulta_id','citas_consultas.id_Cita_Consulta')                                
                                ->join('control_historia_medicas', 'citas_consultas.id_Cita_Consulta','control_historia_medicas.Cita_Consulta_id')                                
                                ->where('control_historia_medicas.cerrado', 1)
                                ->where('control_historia_medicas.factura_generada', 0)
                                ->where('citas_consultas.Paciente_id', $paciente)
                                ->whereDate('citas_consultas.start', $fecha)
                                ->groupBy('servicios.id_servicio','servicios.Servicio','servicios.Costos','servicios.simbolo')
                                ->get();
          
        }
       //dd($servicios);

        $medico=Collection::make(
          UsuarioM::select(['usuarios_medicos.id_Medico', DB::raw('CONCAT(usuarios_medicos.Nombres_Medico, " ", usuarios_medicos.Apellidos_Medicos) AS Nombre')])
          ->join('control_historia_medicas', 'usuarios_medicos.id_Medico', 'control_historia_medicas.Medico_id')
          ->where('usuarios_medicos.Status_Medico_id',1)
          ->where('control_historia_medicas.cerrado', 1)
          ->where('control_historia_medicas.factura_generada', 0)
          ->distinct('usuarios_medicos.id_Medico')
          ->orderBy('usuarios_medicos.Nombres_Medico')
          ->pluck("Nombre", "id_Medico"));

        $pacientes=Collection::make(UsuarioP::select(['id_Paciente',DB::raw('CONCAT(Nombres_Paciente, " ", Apellidos_Paciente) AS Nombre')])->where('Status_id',1)->orderBy('Nombres_Paciente')->pluck("Nombre", "id_Paciente"));
        $status=Collection::make(Status::select(['id_Status','Status'])->orderBy('Status')->get())->pluck("Status", "id_Status");
        $tpago=Collection::make(TipoPago::select(['id_Tipos_Pago','Tipo_Pago'])->orderBy('Tipo_Pago')->pluck("Tipo_Pago", "id_Tipos_Pago"));
        $monedas = ['Bs'=>'Bs','USD'=>'USD'];

        /*CUENTAS*/
        $cbs= Collection::make(CuentaBanco::
             select(['cuenta_bancaria_bs.id_Cuenta_Bancaria_BS AS id', DB::raw('CONCAT(usuarios_medicos.Nombres_Medico, " ",usuarios_medicos. Apellidos_Medicos," - ",bancos_bs.Bancos) AS name')])
             ->join('usuarios_medicos', 'cuenta_bancaria_bs.Medico_id','usuarios_medicos.id_Medico')
             ->join('bancos_bs', 'cuenta_bancaria_bs.Banco_id','bancos_bs.id_Bancos_Bs')
             ->get())->pluck('name','id');

        $cusd= Collection::make(CuentaUSD::
             select(['cuenta_usd.id_Cuenta_USD AS id', DB::raw('CONCAT(usuarios_medicos.Nombres_Medico, " ",usuarios_medicos. Apellidos_Medicos," - ",entidades_usd.Entidad_USD) AS name')])
             ->join('usuarios_medicos', 'cuenta_usd.Medico_id','usuarios_medicos.id_Medico')
             ->join('entidades_usd', 'cuenta_usd.Entidad_USD_id','entidades_usd.id_Entidad_USD')
             ->get())->pluck('name','id');

        $cbilletera= Collection::make(Billetera::
             select(['billeteras_cripto.id_Billetera_Cripto AS id', DB::raw('CONCAT(usuarios_medicos.Nombres_Medico, " ",usuarios_medicos. Apellidos_Medicos," - ",criptos.Criptop) AS name')])
             ->join('usuarios_medicos', 'billeteras_cripto.Medicos_id','usuarios_medicos.id_Medico')
             ->join('criptos', 'billeteras_cripto.Cripto_id','criptos.id_Cripto')
             ->get())->pluck('name','id');

        return view('admin.factura.pago')->with(compact('pacientes','fecha','paciente', 'dataf','servicios','monedas','status','tpago','cbs','cusd','cbilletera','medico','id_medico'));
    }
    public function pdfForm($id)
    {
    	$dataf = ControlHM::where('Paciente_id', $id)->whereDate('Fecha', date('Y-m-d'))->where('cerrado', 1)->first();
    	
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
              $facturaD->Status_Factura_id =$request['Status_Factura_id'];
              $facturaD->save(); 
              
            }
//dd($request['monedaf']);
            switch ($request['monedaf']) {
              case 'Bs':
                  $facturaBs = new FacturaBs();
                  $facturaBs->Factura_id = $factura['id'];
                  $facturaBs->Status_Tasa_id = 1;
                  $facturaBs->Status_Pago = $request['statusf'];
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
                  $facturaUSD->Status_Pago = $request['statusPf'];
                  $facturaUSD->Cuenta_USD_id = $request['cusdf'];
                  $facturaUSD->Total_Cancelado = $request['totalf'];
                  $facturaUSD->Referencia =$request['reff'];
                  $facturaUSD->Tipo_Pago_id =$request['tpagof'];
    			
                  $facturaUSD->impuesto =$request['impuestof'];
                  $facturaUSD->save();
                break;
            }
		 	DB::commit();
      $info = 'Datos de factura agregados correctamente';
      	}catch (Exception $e) {
        	DB::rollback();
			$info= 'Ocurrio un error intente de nuevo';
		}
    $resp= [$info, $factura['id']];
    return response()->json($resp);
		
    }
 
    public function pdfDownload($id){
      
      $factura= Factura::where('id_Factura', $id)->first();
        switch ($factura['moneda_cancela']) {
          case 'Bs':
            $factura_moneda = FacturaBs::where('Factura_Id', $id)->first();
            break;
          
          default:
            $factura_moneda = FacturaUSD::where('Factura_Id', $id)->first();
            break;
        }
      $data= ['factura' => $factura, 'factura_moneda' => $factura_moneda];
      $pdf = PDF::loadView('admin.factura.pdf_download', ['data' => $data]);
   
       return $pdf->download('Factura.pdf');
    }

    public function calcular()
    {
        $tasa= TipoCambio::where('Status_Tasa_id', 1)->first();
       return response()->json($tasa); 
    }
}

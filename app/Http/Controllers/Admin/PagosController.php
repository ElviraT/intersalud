<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\Request;
use App\Model\UsuarioP;
use App\Model\DireccionPaciente;
use App\Model\TipoPago;
use App\Model\CuentaBanco;
use App\Model\CuentaUSD;
use App\Model\Banco;
use App\Model\EntidadesUSD;
use App\Model\PagoConfirmar;
use App\Model\UsuarioM;
use App\User;
use App\Mail\PagoMail;
use Image;
use DB;
use Mail;
use Flash;

class PagosController extends Controller
{
	public function __construct()
    {
      $this->middleware('can:pago')->only('index');
      $this->middleware('can:pago.add')->only('add');
      $this->middleware('can:pago.edit')->only('edit');
      $this->middleware('can:pago.destroy')->only('destroy');
    }
    const UPLOAD_PATH = 'comprobante';
    public function index()
    {
    	$paciente = NULL;
  		$telefono= NULL;
  		$celular = NULL;
  		$correo = NULL;

    	if (auth()->user()->id_usuarioP > 0) {
    		$pacientes=Collection::make(UsuarioP::select(['id_Paciente',DB::raw('CONCAT(Nombres_Paciente, " ", Apellidos_Paciente) AS Nombre')])->where('id_Paciente',auth()->user()->id_usuarioP)->where('Status_id',1)->orderBy('Nombres_Paciente')->pluck("Nombre", "id_Paciente"));
    		$data= DireccionPaciente::select(['Telefono','Celular','Correo'])
                                  ->where('Paciente_id', auth()->user()->id_usuarioP)
                                  ->first();
                                  //dd($pacientes);
    		
    		$paciente = auth()->user()->id_usuarioP;
    		$telefono= $data['Telefono'];
    		$celular = $data['Celular'];
    		$correo = $data['Correo'];

    	}else{
    		$pacientes=Collection::make(UsuarioP::select(['id_Paciente',DB::raw('CONCAT(Nombres_Paciente, " ", Apellidos_Paciente) AS Nombre')])->where('Status_id',1)->orderBy('Nombres_Paciente')->pluck("Nombre", "id_Paciente"));
    	}

    	$monedas = ['Bs'=>'Bs','USD'=>'USD'];
    	$tpago=Collection::make(TipoPago::select(['id_Tipos_Pago','Tipo_Pago'])->orderBy('Tipo_Pago')->pluck("Tipo_Pago", "id_Tipos_Pago"));

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

        $bancos=Collection::make(Banco::select(['id_Bancos_Bs', DB::raw('CONCAT(Codigo_Bancario, " - ",Bancos) AS name')])->orderBy('Bancos')->pluck("name", "id_Bancos_Bs"));

        $entidades=Collection::make(EntidadesUSD::select(['id_Entidad_USD', 'Entidad_USD'])->where('Status_id',1)->orderBy('Entidad_USD')->pluck("Entidad_USD", "id_Entidad_USD"));

        $medico=Collection::make(UsuarioM::select(['id_Medico',DB::raw('CONCAT(Nombres_Medico, " ", Apellidos_Medicos) AS Nombre')])->where('Status_Medico_id',1)->orderBy('Nombres_Medico')->pluck("Nombre", "id_Medico"));


    	return view('pagos.index')->with(compact('pacientes','paciente','telefono','celular','correo','monedas','tpago','cbs','cusd','bancos','entidades','medico'));
    }

    public function add(Request $request)
    {
    	if($request->comprobante) {
          $comprobante = $this->_procesarComprobante($request);
      	}else{
          $comprobante = '';
        }
        if($request['cbs']){

        }
    	  $pago = new PagoConfirmar();
        $pago->Paciente_id = $request['paciente'];
        $pago->moneda_id = $request['moneda'];
        $pago->monto = $request['monto'];
        $pago->referencia =$request['referencia'];
        $pago->fecha_pago = $request['fecha'];
        $pago->tipo_pago = $request['tpago'];
        $pago->cuenta_bs = $request['cbs'];
        $pago->cuenta_usd = $request['cusd'];
        $pago->banco_emisor = $request['banco'];
        $pago->entidad_emisora = $request['entidad'];
        $pago->impuesto_dolar = $request['impuesto'];
        $pago->comprobante = $comprobante;
        $pago->save(); 

        $mails = User::select('email')->where('id',1)->orWhere('id_usuario',$request['medico_id'])->get();

        Mail::to($mails[1]->email)->bcc($mails[0]->email)->send(new PagoMail($pago));

        Flash::success("Pago enviado Correctamente");
        
    	return redirect()->route('pago');
    }

    private function _procesarComprobante(Request $request)
    {          
      if ($request->hasFile('comprobante')) {
         $tmp = $request->file('comprobante');
      
          if ($tmp->isValid()) {
              $extension = $tmp->extension();
              $nombreArchivo = sprintf('%s_%s.%s','comprobante',$request['paciente'].'_'.$request['fecha'],$extension);
              $ubicacion = $tmp->storeAs(
                  self::UPLOAD_PATH,
                  $nombreArchivo
              );
            $ubicacion = $this->separadorDirectorios($ubicacion);         
           return $ubicacion;
          }
      }
    }
    public function separadorDirectorios($path){

      return str_replace(['\\','/'], DIRECTORY_SEPARATOR, $path);
    }
}

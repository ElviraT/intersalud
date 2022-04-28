<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\Request;
use App\Model\Servicio;
use App\Model\Status;
use App\Model\Especialidad;
use App\Model\UsuarioM;
use App\Model\UsuarioA;
use Flash;
use DB;

class ServiciosController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:servicio')->only('index');
      $this->middleware('can:servicio.add')->only('add');
      $this->middleware('can:servicio.edit')->only('edit');
      $this->middleware('can:servicio.destroy')->only('destroy');
    }
    public function index(Servicio $model)
  	{   
      if(auth()->user()->name == 'Admin'){
        $servicios = Servicio::all();
        $medico=Collection::make(UsuarioM::select(['id_Medico',DB::raw('CONCAT(Nombres_Medico, " ", Apellidos_Medicos) AS Nombre')])->where('Status_Medico_id',1)->orderBy('Nombres_Medico')->pluck("Nombre", "id_Medico"));
       }elseif(auth()->user()->id_usuario > 0 ){
        $servicios = Servicio::where('Medico_id',auth()->user()->id_usuario)->get();
        $medico=Collection::make(UsuarioM::select(['id_Medico',DB::raw('CONCAT(Nombres_Medico, " ", Apellidos_Medicos) AS Nombre')])->where('Status_Medico_id',1)->where('id_Medico',auth()->user()->id_usuario)->orderBy('Nombres_Medico')->pluck("Nombre", "id_Medico"));

       }elseif(auth()->user()->id_usuarioA > 0 ){
        $asistente = UsuarioA::where('id_asistente',auth()->user()->id_usuarioA)->first();
        $servicios = Servicio::where('Medico_id',$asistente->id_Medico)->get();
        $medico=Collection::make(UsuarioM::select(['id_Medico',DB::raw('CONCAT(Nombres_Medico, " ", Apellidos_Medicos) AS Nombre')])->where('Status_Medico_id',1)->where('id_Medico',$asistente->id_Medico)->orderBy('Nombres_Medico')->pluck("Nombre", "id_Medico"));
       }
  		$status=Collection::make(Status::select(['id_Status','Status'])->orderBy('Status')->get())->pluck("Status", "id_Status");

  		$especialidad=Collection::make(Especialidad::select(['id_Especialidad_Medica','Espacialiadad_Medica'])->orderBy('Espacialiadad_Medica')->get())->pluck("Espacialiadad_Medica", "id_Especialidad_Medica"); 
      $simbol = ['Bs'=>'Bs','USD'=>'USD'];//,'Btc'=>'Btc','Eth'=>'Eth'];
      
  		return view('admin.servicios.index', ['servicios' => $servicios,'status'=>$status,'medico'=>$medico,'especialidad'=>$especialidad,'simbol'=>$simbol]);
  	}
  	public function add (Request $request)
    {   
  
       if($request->id == 0){
            try {
                $servicio= new Servicio();
                $servicio->Servicio = $request['servicio'];
                $servicio->Costos = $request['costo'];
                $servicio->simbolo = $request['simbolo'];
                $servicio->Especialidad_Medica_id = $request['especialidad'];
                $servicio->Medico_id = $request['medico_id'];
                $servicio->Status_id = $request['status'];
                $servicio->duracion = $request['duracion'];
                $servicio->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error('Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 Servicio::where('id_Servicio', $id)->update([
                    'Servicio'=>$request->servicio,
                    'Costos'=>$request->costo,
                    'simbolo'=>$request->simbolo,
                    'Especialidad_Medica_id'=>$request->especialidad,
                    'Medico_id'=>$request->medico_id,
                    'Status_id'=>$request->status,
                    'duracion'=>$request->duracion,
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('servicio');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $servicio= Servicio::where('id_Servicio', $id)->first();
        return response()->json([$servicio]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
        Servicio::where('id_Servicio', $id)->update(['Status_id'=>2]);
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('servicio');
    }
}

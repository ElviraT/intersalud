<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\Request;
use App\Model\Servicio;
use App\Model\Status;
use App\Model\Especialidad;
use App\Model\UsuarioM;
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
  		$status=Collection::make(Status::select(['id_Status','Status'])->orderBy('Status')->get())->pluck("Status", "id_Status");

  		$especialidad=Collection::make(Especialidad::select(['id_Especialidad_Medica','Espacialiadad_Medica'])->orderBy('Espacialiadad_Medica')->get())->pluck("Espacialiadad_Medica", "id_Especialidad_Medica"); 

  		$medico=Collection::make(UsuarioM::select(['id_Medico',DB::raw('CONCAT(Nombres_Medico, " ", Apellidos_Medicos) AS Nombre')])->where('Status_Medico_id',1)->orderBy('Nombres_Medico')->pluck("Nombre", "id_Medico"));

  		return view('admin.servicios.index', ['servicios' => $model->all(),'status'=>$status,'medico'=>$medico,'especialidad'=>$especialidad]);
  	}
  	public function add (Request $request)
    {   
  
       if($request->id == 0){
            try {
                $servicio= new Servicio();
                $servicio->Servicio = $request['servicio'];
                $servicio->Costos = $request['costo'];
                $servicio->Especialidad_Medica_id = $request['especialidad'];
                $servicio->Medico_id = $request['medico_id'];
                $servicio->Status_id = $request['status'];
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
                    'Especialidad_Medica_id'=>$request->especialidad,
                    'Medico_id'=>$request->medico_id,
                    'Status_id'=>$request->status,
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

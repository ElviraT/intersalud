<?php

namespace App\Http\Controllers\Admin\configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use App\Model\Agenda;
use App\Model\UsuarioM;
use App\Model\UsuarioP;
use App\Model\UsuarioPE;
use App\Model\Consultorio;
use App\Model\Horario;
use App\Model\Status;
use App\Model\Especialidad;
use Flash;
use DB;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
    	if(auth()->user()->name == 'Admin'){
         $medico=Collection::make(UsuarioM::select(['id_Medico',DB::raw('CONCAT(Nombres_Medico, " ", Apellidos_Medicos) AS Nombre')])->where('Status_Medico_id',1)->orderBy('Nombres_Medico')->pluck("Nombre", "id_Medico"));

          $especialidad = Collection::make(Especialidad::select(['id_Especialidad_Medica','Espacialiadad_Medica'])->orderBy('Espacialiadad_Medica')->pluck("Espacialiadad_Medica", "id_Especialidad_Medica")); 

          $agendas = Agenda::all();
           $horarios= Collection::make(Horario::
             select(['horarios_citas.id_Horario_Cita AS id', DB::raw('CONCAT(usuarios_medicos.Nombres_Medico, " ",usuarios_medicos. Apellidos_Medicos," - ",especialidades_medicas.Espacialiadad_Medica ) AS name')])
             ->join('usuarios_medicos', 'horarios_citas.Medico_id','usuarios_medicos.id_Medico')
             ->join('especialidades_medicas', 'horarios_citas.Especialidad_id','especialidades_medicas.id_Especialidad_Medica')
             ->get())->pluck('name','id'); 

      }else{
          $medico=Collection::make(UsuarioM::select(['id_Medico',DB::raw('CONCAT(Nombres_Medico, " ", Apellidos_Medicos) AS Nombre')])->where('Status_Medico_id',1)->where('id_Medico',auth()->user()->id_usuario)->orderBy('Nombres_Medico')->pluck("Nombre", "id_Medico"));

           $especialidad = Collection::make(Especialidad::
             select('especialidades_medicas.id_Especialidad_Medica AS id', 'especialidades_medicas.Espacialiadad_Medica AS name')
             ->join('control_especialidades', 'especialidades_medicas.id','control_especialidades.Especialidades_Medicas_id')
             ->where('control_especialidades.Medico_id',auth()->user()->id_usuario)
             ->get())->pluck('name','id'); 

           $agendas = Agenda::where('Medico_id',auth()->user()->id_usuario)->get();
          $horarios= Collection::make(Horario::
             select(['horarios_citas.id_Horario_Cita AS id', DB::raw('CONCAT(usuarios_medicos.Nombres_Medico, " ",usuarios_medicos. Apellidos_Medicos," - ",especialidades_medicas.Espacialiadad_Medica ) AS name')])
             ->join('usuarios_medicos', 'horarios_citas.Medico_id','usuarios_medicos.id_Medico')
             ->join('especialidades_medicas', 'horarios_citas.Especialidad_id','especialidades_medicas.id_Especialidad_Medica')
             ->where('Medico_id',auth()->user()->id_usuario)
             ->get())->pluck('name','id'); 
      }

      	$consultorios = Collection::make(Consultorio::select(['id_Consultorio','Local'])->orderBy('Local')->get())->pluck("Local", "id_Consultorio");

      	$status=Collection::make(Status::select(['id_Status','Status'])->orderBy('Status')->get())->pluck("Status", "id_Status");
      	           	

    	return view('admin.configuracion.agendas.index')->with(compact('agendas','medico','especialidad','consultorios','status','horarios'));
    }

    public function add(Request $request)
    {
    	if($request->id == 0){
            try {
                $Agenda= new Agenda();
                $Agenda->Medico_id = ucfirst($request['medico']);
                $Agenda->Consultorio_id = $request['consultorio'];
                $Agenda->Especialidad_Medica = $request['especialidad'];
                $Agenda->Horario_Cita_id = $request['horario'];
                $Agenda->Costo_consulta = $request['costo'];
                $Agenda->Max_pacientes = $request['mpaciente'];
                $Agenda->Status_id = $request['status'];
                $Agenda->Nota = $request['nota'];
                $Agenda->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error('Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 Agenda::where('id_Agenda', $id)->update([
                    'Medico_id'=>ucfirst($request->medico),
                    'Consultorio_id'=>$request->consultorio,
                    'Especialidad_Medica'=>$request->especialidad,
                    'Horario_Cita_id' => $request->horario,
                    'Costo_consulta'=>$request->costo,
                    'Max_pacientes'=>$request->mpaciente,
                    'Status_id'=>$request->status,
                    'Nota'=>$request->nota
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
    	return redirect()->route('agendas');
    }

    public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $agenda= Agenda::where('id_Agenda', $id)->first();
        return response()->json([$agenda]);
    }
}

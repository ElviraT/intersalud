<?php

namespace App\Http\Controllers\Admin\configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use App\Model\Agenda;
use App\Model\UsuarioM;
use App\Model\UsuarioA;
use App\Model\UsuarioP;
use App\Model\UsuarioPE;
use App\Model\Especialidad;
use App\Model\Citas;
use App\Model\ControlHM;
use App\Model\Servicio;
use DB;

class CitasController extends Controller
{
   public function __construct()
    {
      $this->middleware('can:citas')->only('index');
      $this->middleware('can:citas.add')->only('add');
      $this->middleware('can:citas.edit')->only('edit');
      $this->middleware('can:citas.destroy')->only('destroy');
    } 
    public function index(Request $request)
    {
    	if(auth()->user()->name == 'Admin'){
         $servicios = Collection::make(Servicio::select(['id_Servicio','Servicio'])->where('Status_id',1)->orderBy('Servicio')->pluck("Servicio", "id_Servicio"));

         $medico=Collection::make(UsuarioM::select(['id_Medico',DB::raw('CONCAT(Nombres_Medico, " ", Apellidos_Medicos) AS Nombre')])->where('Status_Medico_id',1)->orderBy('Nombres_Medico')->pluck("Nombre", "id_Medico"));

          $especialidad = Collection::make(Especialidad::select(['id_Especialidad_Medica','Espacialiadad_Medica'])->orderBy('Espacialiadad_Medica')->pluck("Espacialiadad_Medica", "id_Especialidad_Medica")); 

          $agenda= Collection::make(Agenda::
             select(['agendas.id_Agenda AS id', DB::raw('CONCAT(usuarios_medicos.Nombres_Medico, " ",usuarios_medicos. Apellidos_Medicos," - ",especialidades_medicas.Espacialiadad_Medica ) AS name')])
             ->join('usuarios_medicos', 'agendas.Medico_id','usuarios_medicos.id_Medico')
             ->join('especialidades_medicas', 'agendas.Especialidad_Medica','especialidades_medicas.id_Especialidad_Medica')
             ->where('agendas.Status_id', 1)
             ->get())->pluck('name','id');
          
          $pacientes=Collection::make(UsuarioP::select(['id_Paciente',DB::raw('CONCAT(Nombres_Paciente, " ", Apellidos_Paciente) AS Nombre')])->where('Status_id',1)->orderBy('Nombres_Paciente')->pluck("Nombre", "id_Paciente"));

      }elseif(auth()->user()->id_usuario > 0 ){
          $servicios = Collection::make(Servicio::select(['id_Servicio','Servicio'])->where('Status_id',1)->where('Medico_id',auth()->user()->id_usuario)->orderBy('Servicio')->pluck("Servicio", "id_Servicio"));

          $medico=Collection::make(UsuarioM::select(['id_Medico',DB::raw('CONCAT(Nombres_Medico, " ", Apellidos_Medicos) AS Nombre')])->where('Status_Medico_id',1)->where('id_Medico',auth()->user()->id_usuario)->orderBy('Nombres_Medico')->pluck("Nombre", "id_Medico"));

           $especialidad = Collection::make(Especialidad::
             select('especialidades_medicas.id_Especialidad_Medica AS id', 'especialidades_medicas.Espacialiadad_Medica AS name')
             ->join('control_especialidades', 'especialidades_medicas.id_Especialidad_Medica','control_especialidades.Especialidades_Medicas_id')
             ->where('control_especialidades.Medico_id',auth()->user()->id_usuario)
             ->get())->pluck('name','id'); 

           $agenda= Collection::make(Agenda::
             select(['agendas.id_Agenda AS id', DB::raw('CONCAT(usuarios_medicos.Nombres_Medico, " ",usuarios_medicos. Apellidos_Medicos," - ",especialidades_medicas.Espacialiadad_Medica ) AS name')])
             ->join('usuarios_medicos', 'agendas.Medico_id','usuarios_medicos.id_Medico')
             ->join('especialidades_medicas', 'agendas.Especialidad_Medica','especialidades_medicas.id_Especialidad_Medica')
             ->where('usuarios_medicos.id_Medico', auth()->user()->id_usuario)
             ->where('agendas.Status_id', 1)
             ->get())->pluck('name','id');

          $pacientes=Collection::make(UsuarioP::select(['id_Paciente',DB::raw('CONCAT(Nombres_Paciente, " ", Apellidos_Paciente) AS Nombre')])->where('Status_id',1)->orderBy('Nombres_Paciente')->pluck("Nombre", "id_Paciente"));

      }elseif(auth()->user()->id_usuarioA > 0){
          $asistente = UsuarioA::where('id_asistente',auth()->user()->id_usuarioA)->first();
          $servicios = Collection::make(Servicio::select(['id_Servicio','Servicio'])->where('Status_id',1)->where('Medico_id',$asistente->id_Medico)->orderBy('Servicio')->pluck("Servicio", "id_Servicio"));

          $medico=Collection::make(UsuarioM::select(['id_Medico',DB::raw('CONCAT(Nombres_Medico, " ", Apellidos_Medicos) AS Nombre')])->where('Status_Medico_id',1)->where('id_Medico',$asistente->id_Medico)->orderBy('Nombres_Medico')->pluck("Nombre", "id_Medico"));

           $especialidad = Collection::make(Especialidad::
             select('especialidades_medicas.id_Especialidad_Medica AS id', 'especialidades_medicas.Espacialiadad_Medica AS name')
             ->join('control_especialidades', 'especialidades_medicas.id_Especialidad_Medica','control_especialidades.Especialidades_Medicas_id')
             ->where('control_especialidades.Medico_id',$asistente->id_Medico)
             ->get())->pluck('name','id'); 

           $agenda= Collection::make(Agenda::
             select(['agendas.id_Agenda AS id', DB::raw('CONCAT(usuarios_medicos.Nombres_Medico, " ",usuarios_medicos. Apellidos_Medicos," - ",especialidades_medicas.Espacialiadad_Medica ) AS name')])
             ->join('usuarios_medicos', 'agendas.Medico_id','usuarios_medicos.id_Medico')
             ->join('especialidades_medicas', 'agendas.Especialidad_Medica','especialidades_medicas.id_Especialidad_Medica')
             ->where('usuarios_medicos.id_Medico', $asistente->id_Medico)
             ->where('agendas.Status_id', 1)
             ->get())->pluck('name','id');

          $pacientes=Collection::make(UsuarioP::select(['id_Paciente',DB::raw('CONCAT(Nombres_Paciente, " ", Apellidos_Paciente) AS Nombre')])->where('Status_id',1)->orderBy('Nombres_Paciente')->pluck("Nombre", "id_Paciente",'servicios'));

      }elseif(auth()->user()->id_usuarioP > 0){
        $servicios = Collection::make(Servicio::select(['id_Servicio','Servicio'])->where('Status_id',1)->orderBy('Servicio')->pluck("Servicio", "id_Servicio"));

         $medico=Collection::make(UsuarioM::select(['id_Medico',DB::raw('CONCAT(Nombres_Medico, " ", Apellidos_Medicos) AS Nombre')])->where('Status_Medico_id',1)->orderBy('Nombres_Medico')->pluck("Nombre", "id_Medico"));

          $especialidad = Collection::make(Especialidad::select(['id_Especialidad_Medica','Espacialiadad_Medica'])->orderBy('Espacialiadad_Medica')->pluck("Espacialiadad_Medica", "id_Especialidad_Medica")); 

          $agenda= Collection::make(Agenda::
             select(['agendas.id_Agenda AS id', DB::raw('CONCAT(usuarios_medicos.Nombres_Medico, " ",usuarios_medicos. Apellidos_Medicos," - ",especialidades_medicas.Espacialiadad_Medica ) AS name')])
             ->join('usuarios_medicos', 'agendas.Medico_id','usuarios_medicos.id_Medico')
             ->join('especialidades_medicas', 'agendas.Especialidad_Medica','especialidades_medicas.id_Especialidad_Medica')
             ->where('agendas.Status_id', 1)
             ->get())->pluck('name','id');

          $pacientes=Collection::make(UsuarioP::select(['id_Paciente',DB::raw('CONCAT(Nombres_Paciente, " ", Apellidos_Paciente) AS Nombre')])->where('Status_id',1)->where('id_Paciente',auth()->user()->id_usuarioP)->orderBy('Nombres_Paciente')->pluck("Nombre", "id_Paciente"));
      }
          $pacientesE = Collection::make(UsuarioPE::
             select(['pacientes_especiales.id_Pacientes_Especiales AS id', DB::raw('CONCAT(pacientes_especiales.Nombre_Paciente_Especial, " ",pacientes_especiales. Apellido_Paciente_Especial) AS name')])
             ->join('usuarios_pacientes', 'pacientes_especiales.Paciente_id','usuarios_pacientes.id_Paciente')
             ->get())->pluck('name','id'); 

    	return view('admin.configuracion.citas.index')->with(compact('medico','especialidad','pacientes','pacientesE','agenda','servicios'));
    }

    public function show ($id)
    {
      $citas = Citas::where('Agenda_id', $id)->get();
      return response()->json($citas);
    }
    public function store(Request $request)
    {
      $confirmado=1;
      $color= '#378006';
      $title = $request['titleP'].' - '.$request['title'];

      $agenda= Agenda::where('id_Agenda',$request->Agenda_id)->first();
      $Medico_id=$agenda['Medico_id'];
      $Horario_Cita_Paciente=$agenda['Horario_Cita_id'];
      $Especialidad_Medica=$agenda['Especialidad_Medica'];

      $request->merge(['color' => $color,'confirmado' => $confirmado, 'title'=> $title, 'Medico_id'=> $Medico_id, 'Horario_Cita_Paciente'=> $Horario_Cita_Paciente]);
      $data = $request->all();
      DB::beginTransaction();
      try {
        $cita= Citas::create($data);
        
        $control_data = ['Especialidad_Medica_id' => $Especialidad_Medica, 'Medico_id'=> $Medico_id, 'Paciente_id'=> $request['Paciente_id'], 'Paciente_Especial_id'=> $request['Paciente_Especial_id'], 'Cita_Consulta_id'=> $cita['id_Cita_Consulta'], 'Fecha'=> date('Y-m-d'), 'id_servicio'=> $request['id_servicio'];

        $control= ControlHM::create($control_data);
         DB::commit();
      } catch (Exception $e) {
        DB::rollback();
      }
      
    	return redirect()->route('citas');
    }
    public function edit($id)
    {
      $cita = Citas::where('id_Cita_Consulta', $id)->get();
      return response()->json($cita);
    }
    public function destroy($id)
    {
      $cita = Citas::where('id_Cita_Consulta', $id)->delete();
      return response()->json($cita);
    }
    public function update(Request $request)
    {
        $confirmado=1;
        $color= '#378006'; 
       $title = $request['titleP'].' - '.$request['title'];
                
      $request->merge(['color' => $color,'confirmado' => $confirmado, 'title'=> $title]);
      $data = $request->all();
      $data = $request->except('_token','id','titleP');

      $cita = Citas::where('id_Cita_Consulta', $request['id'])->update($data);
      return response()->json($cita);
    }
}

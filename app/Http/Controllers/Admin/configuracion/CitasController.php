<?php

namespace App\Http\Controllers\Admin\configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use App\Model\Agenda;
use App\Model\UsuarioM;
use App\Model\UsuarioP;
use App\Model\UsuarioPE;
use App\Model\Especialidad;
use App\Model\Citas;
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
         $medico=Collection::make(UsuarioM::select(['id_Medico',DB::raw('CONCAT(Nombres_Medico, " ", Apellidos_Medicos) AS Nombre')])->where('Status_Medico_id',1)->orderBy('Nombres_Medico')->pluck("Nombre", "id_Medico"));

          $especialidad = Collection::make(Especialidad::select(['id_Especialidad_Medica','Espacialiadad_Medica'])->orderBy('Espacialiadad_Medica')->pluck("Espacialiadad_Medica", "id_Especialidad_Medica")); 

          $agenda= Collection::make(Agenda::
             select(['agendas.id_Agenda AS id', DB::raw('CONCAT(usuarios_medicos.Nombres_Medico, " ",usuarios_medicos. Apellidos_Medicos," - ",especialidades_medicas.Espacialiadad_Medica ) AS name')])
             ->join('usuarios_medicos', 'agendas.Medico_id','usuarios_medicos.id_Medico')
             ->join('especialidades_medicas', 'agendas.Especialidad_Medica','especialidades_medicas.id_Especialidad_Medica')
             ->where('agendas.Status_id', 1)
             ->get())->pluck('name','id');

      }else{
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
      }



      		$pacientes=Collection::make(UsuarioP::select(['id_Paciente',DB::raw('CONCAT(Nombres_Paciente, " ", Apellidos_Paciente) AS Nombre')])->where('Status_id',1)->orderBy('Nombres_Paciente')->pluck("Nombre", "id_Paciente"));

           	$pacientesE = Collection::make(UsuarioPE::
             select(['pacientes_especiales.id_Pacientes_Especiales AS id', DB::raw('CONCAT(pacientes_especiales.Nombre_Paciente_Especial, " ",pacientes_especiales. Apellido_Paciente_Especial) AS name')])
             ->join('usuarios_pacientes', 'pacientes_especiales.Paciente_id','usuarios_pacientes.id_Paciente')
             ->get())->pluck('name','id'); 

    	return view('admin.configuracion.citas.index')->with(compact('medico','especialidad','pacientes','pacientesE','agenda'));
    }

    public function show ($id)
    {
      $citas = Citas::where('Agenda_id', $id)->get();
      return response()->json($citas);
    }
    public function store(Request $request)
    {
      if($request['confirmado'] == 'on'){
          $confirmado=1;
          $color= '#378006';
      }else{
          $confirmado=0;
          $color= '#f4b60b';
      }
                
      $request->merge(['color' => $color,'confirmado' => $confirmado]);
      $data = $request->all();
      $cita= Citas::create($data);
      
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
      if($request['confirmado'] == 'on'){
          $confirmado=1;
          $color= '#378006';
      }else{
          $confirmado=0;
          $color= '#f4b60b';
      }
                
      $request->merge(['color' => $color,'confirmado' => $confirmado]);
      $data = $request->all();
      $data = $request->except('_token','id');

      $cita = Citas::where('id_Cita_Consulta', $request['id'])->update($data);
      return response()->json($cita);
    }
}

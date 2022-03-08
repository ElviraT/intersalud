<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Model\Ciudad;
use App\Model\Municipio;
use App\Model\Especialidad;
use App\Model\Parroquia;
use App\Model\UsuarioPE;
use App\Model\UsuarioP;
use App\Model\Consultorio;
use App\Model\Horario;
use App\Model\Agenda;
use App\Model\Citas;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function ciudad(Request $request){
      $id = empty($request->input('estado')) ? 0 : $request->input('estado');
      $ciudades = [];

      if ($id > 0) {
        $ciudades = Ciudad::where('Estado_id', $id)
                        ->orderBy('Ciudad')->get(); 
      }
        return response()->json($ciudades);
    }

    public function municipio(Request $request){
      $id = empty($request->input('estado')) ? 0 : $request->input('estado');
      $municipios = [];

      if ($id > 0) {
        $municipios = Municipio::where('Estado_id', $id)
                        ->orderBy('Municipio')->get(); 
      }
        return response()->json($municipios);
    }

    public function parroquia(Request $request){
      $id = empty($request->input('municipio')) ? 0 : $request->input('municipio');
      $parroquias = [];

      if ($id > 0) {
        $parroquias = Parroquia::where('Municipio_id', $id)
                        ->orderBy('Parroquia')->get(); 
      }
        return response()->json($parroquias);
    }
    public function consultorio(Request $request)
    {
      $id = empty($request->input('especialidad')) ? 0 : $request->input('especialidad');
      $consultorio = [];

      if ($id > 0) {
        $consultorio = Consultorio::where('Especialidad_Medica_id', $id)
                        ->orderBy('Local')->get(); 
      }
        return response()->json($consultorio);
    }
     public function especialidad(Request $request){
      $id = empty($request->input('medico')) ? 0 : $request->input('medico');
      $especialidades = [];

      if ($id > 0) {
        $especialidades = Especialidad::
       select('especialidades_medicas.id_Especialidad_Medica AS id', 'especialidades_medicas.Espacialiadad_Medica AS name')
       ->join('control_especialidades', 'especialidades_medicas.id_Especialidad_Medica','control_especialidades.Especialidades_Medicas_id')
       ->where('control_especialidades.Medico_id',$id)
       ->get(); 
      }
        return response()->json($especialidades);
    }

    public function paciente_especial(Request $request){
      $id = empty($request->input('paciente')) ? 0 : $request->input('paciente');
      $pacientesE = [];

      if ($id > 0) {
        $pacientesE = UsuarioPE::
             select(['pacientes_especiales.id_Pacientes_Especiales AS id', DB::raw('CONCAT(pacientes_especiales.Nombre_Paciente_Especial, " ",pacientes_especiales. Apellido_Paciente_Especial) AS name')])
             ->join('usuarios_pacientes', 'pacientes_especiales.Paciente_id','usuarios_pacientes.id_Paciente')
             ->where('pacientes_especiales.Paciente_id',$id)
             ->get();
      }
        return response()->json($pacientesE);
    }

    public function consultar_horario(Request $request){
      $agenda = empty($request->input('agenda')) ? 0 : $request->input('agenda');

      $horarios = [];

      if ($agenda > 0) {
         $horarios = Horario::select('*')
             ->join('agendas', 'horarios_citas.id_Horario_Cita','agendas.Horario_Cita_id')
             ->where('agendas.id_Agenda',$agenda)
             ->first();
      }

      return response()->json($horarios);
    }

    public function datos_agenda(Request $request){
      $agenda2 = empty($request->input('agenda2')) ? 0 : $request->input('agenda2');

      $Dagenda = [];

      if ($agenda2 > 0) {
         $Dagenda = Agenda::where('id_Agenda',$agenda2)->first();
      }

      return response()->json($Dagenda);
    }
    public function horario_datos(Request $request){
      $horario = empty($request->input('horario')) ? 0 : $request->input('horario');

      $Dhorario = [];

      if ($horario > 0) {
        $Dhorario = Horario::where('id_Horario_Cita',$horario)->first();
      }

      return response()->json($Dhorario);
    }

    public function disponibilidad(Request $request){
      $agenda = empty($request->input('agenda')) ? 0 : $request->input('agenda');
      $start = empty($request->input('start')) ? null : $request->input('start');

      $citas = [];

      if ($agenda > 0) {
        $citas = DB::table('citas_consultas')
                   ->select(DB::raw("count('Agenda_id') as count, Max_paciente"))
                   ->where('Agenda_id',$agenda)
                   ->where('confirmado',1)
                   ->whereDate('start',$start)
                   ->groupBy('Agenda_id','Max_paciente')
                   ->first();
      }

      return response()->json($citas);
    }

    public function buscar_paciente(Request $request){
     $paciente = empty($request->input('paciente')) ? null : $request->input('paciente');
     $pacienteE = empty($request->input('pacienteE')) ? null : $request->input('pacienteE');
      $datos = [];
      if ($pacienteE != null) {
         $datos = UsuarioPE::select('pacientes_especiales.Nombre_Paciente_Especial', 'pacientes_especiales.Apellido_Paciente_Especial', 'pacientes_especiales.Fecha_Nacimiento_Paciente_Especial', 'sexos.Sexo')
             ->join('sexos', 'sexos.id_Sexo','pacientes_especiales.id_Pacientes_Especiales')
             ->where('pacientes_especiales.id_Pacientes_Especiales',$pacienteE)
             ->first();       
      }else{
//dd($paciente);
         $datos = UsuarioP::select('usuarios_pacientes.Nombres_Paciente', 'usuarios_pacientes.Apellidos_Paciente', 'usuarios_pacientes.Fecha_Nacimiento_Paciente', 'sexos.Sexo')
             ->join('sexos', 'sexos.id_Sexo','usuarios_pacientes.id_Paciente')
             ->where('usuarios_pacientes.id_Paciente',$paciente)
             ->first();
      }

      return response()->json($datos);
    }
}

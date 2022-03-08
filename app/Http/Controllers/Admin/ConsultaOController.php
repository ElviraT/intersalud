<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\Request;
use App\Model\UsuarioP;
use App\Model\UsuarioPE;
use App\Model\UsuarioM;
use App\Model\Especialidad;
use App\Model\Antecedente;
use DB;

class ConsultaOController extends Controller
{
	public function __construct()
    {
      $this->middleware('can:consultao')->only('index');
      $this->middleware('can:consultao.add')->only('add');
      $this->middleware('can:consultao.edit')->only('edit');
      $this->middleware('can:consultao.destroy')->only('destroy');
    }

   public function index()
   {
   		$medico = UsuarioM::where('id_Medico', auth()->user()->id_usuario)->first(); 
   		$especialidad = Especialidad::
	       select('especialidades_medicas.id_Especialidad_Medica AS id', 'especialidades_medicas.Espacialiadad_Medica AS name')
	       ->join('control_especialidades', 'especialidades_medicas.id_Especialidad_Medica','control_especialidades.Especialidades_Medicas_id')
	       ->where('control_especialidades.Medico_id', auth()->user()->id_usuario)
	       ->first();
   		$pacientes=Collection::make(UsuarioP::select(['id_Paciente',DB::raw('CONCAT(Nombres_Paciente, " ", Apellidos_Paciente) AS Nombre')])->where('Status_id',1)->orderBy('Nombres_Paciente')->pluck("Nombre", "id_Paciente"));
		$pacientesE = Collection::make(UsuarioPE::
             select(['pacientes_especiales.id_Pacientes_Especiales AS id', DB::raw('CONCAT(pacientes_especiales.Nombre_Paciente_Especial, " ",pacientes_especiales. Apellido_Paciente_Especial) AS name')])
             ->join('usuarios_pacientes', 'pacientes_especiales.Paciente_id','usuarios_pacientes.id_Paciente')
             ->get())->pluck('name','id'); 
    	return view('admin.consultaO.index')->with(compact('pacientes','pacientesE','medico','especialidad'));
   }

   public function add()
   {
     try {
            $consultao= new Antecedente();
            $consultao->Paciente_Id = $_POST['id_paciente'];
            $consultao->Paciente_Especial_id = $_POST['id_pacienteE'];
            $consultao->Medico_id = $_POST['id_medico'];
            $consultao->Fecha = $_POST['fecha'];
            $consultao->Control_Historia_Medico_id =0;
            $consultao->id_Status = 1;
            $consultao->Personal = $_POST['personales'];;
            $consultao->Familiar = $_POST['familiares'];
            $consultao->Farmacologico = $_POST['farmacologicos'];
            $consultao->Examen_Fisico = $_POST['fisico'];
            $consultao->Imprecion_Diagnostica = $_POST['impresion'];
            $consultao->save(); 

            $info= 'Registro Agregado Correctamente';     
         
        } catch (\Illuminate\Database\QueryException $e) {
            $info= $e.'Ocurrio un error intente de nuevo'; 
        }
        return $info;
   }
}

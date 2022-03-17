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
use App\Model\Anamenesi;
use App\Model\Citas;
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

   public function antecedentes()
   {
      if($_POST['id_antecedente'] == 0){
         try {
                $consultao= new Antecedente();
                $consultao->Paciente_Id = $_POST['id_paciente'];
                $consultao->Paciente_Especial_id = $_POST['id_pacienteE'];
                $consultao->Medico_id = $_POST['id_medico'];
                $consultao->Fecha = $_POST['fecha'];
                //$consultao->Control_Historia_Medico_id ='';
                $consultao->id_Status = 1;
                $consultao->Personal = $_POST['personales'];;
                $consultao->Familiar = $_POST['familiares'];
                $consultao->Farmacologico = $_POST['farmacologicos'];
                $consultao->Examen_Fisico = $_POST['fisico'];
                $consultao->Imprecion_Diagnostica = $_POST['impresion'];
                $consultao->save(); 

                $info= 'Registro Agregado Correctamente';     
             
            } catch (\Illuminate\Database\QueryException $e) {
                $info= 'Ocurrio un error intente de nuevo'; 
            }
      }else{
        try{
            $id = (int)$_POST['id_antecedente'];
             Antecedente::where('id_antecedente', $id)->update([
                'Fecha'=> $_POST['fecha'],
                'Personal' =>$_POST['personales'],
                'Familiar'=> $_POST['familiares'],
                'Farmacologico'=> $_POST['farmacologicos'],
                'Examen_Fisico' =>$_POST['fisico'],
                'Imprecion_Diagnostica'=> $_POST['impresion'],
            ]);

             $info= 'Registro Actualizado Correctamente';
        }catch(\Illuminate\Database\QueryException $e){                    
            $info= 'Ocurrio un error intente de nuevo';
        }
      }
        return $info;
   }
   public function anamenesis()
   {
     try {
            $consultao2= new Anamenesi();
            $consultao2->Paciente_Id = $_POST['id_paciente'];
            $consultao2->Paciente_Especial_id = $_POST['id_pacienteE'];
            $consultao2->Medico_id = $_POST['id_medico'];
            $consultao2->Fecha = $_POST['fecha'];
            //$consultao2->Control_Historia_Medico_id ='';
            $consultao2->Enfermedad_Actual = $_POST['Eactual'];
            $consultao2->Origen = $_POST['origen'];;
            $consultao2->Hallazgo = $_POST['hallazgo'];
            $consultao2->Plan_Tratamiento = $_POST['tratamiento'];
            $consultao2->Diagnostico_Definitivo = $_POST['diagnostico'];
            $consultao2->Pronostico = $_POST['pronostico'];
            $consultao2->id_Status = 1;
            $consultao2->Peso = $_POST['peso'];
            $consultao2->Talla = $_POST['estatura'];
            $consultao2->save(); 

            $info= 'Registro Agregado Correctamente';     
         
        } catch (\Illuminate\Database\QueryException $e) {
            $info= $e.'Ocurrio un error intente de nuevo'; 
        }
        return $info;
   }

    public function buscar_paciente(Request $request){
     $paciente = empty($request->input('paciente')) ? null : $request->input('paciente');
     $pacienteE = empty($request->input('pacienteE')) ? null : $request->input('pacienteE');
     $medico = empty($request->input('medico')) ? null : $request->input('medico');
     $datos = [];
     $antecedentes= [];
        
      $cita= Citas::where('Paciente_id',$paciente)
                  ->where('Paciente_Especial_id', $pacienteE)
                  ->where('Medico_id', $medico)
                  ->whereDate('start', date('Y-m-d'))//date('Y-m-d'))
                  ->whereTime('start', date('h:00'))//date('h:00'))
                  ->first();
                  
      if($cita){
        if ($pacienteE != null) {
           $datos = UsuarioPE::select('pacientes_especiales.Nombre_Paciente_Especial', 'pacientes_especiales.Apellido_Paciente_Especial', 'pacientes_especiales.Fecha_Nacimiento_Paciente_Especial', 'sexos.Sexo')
               ->join('sexos', 'sexos.id_Sexo','pacientes_especiales.Sexo_id')
               ->where('pacientes_especiales.id_Pacientes_Especiales',$pacienteE)
               ->first();       
        }else{
           $datos = UsuarioP::select('usuarios_pacientes.Nombres_Paciente', 'usuarios_pacientes.Apellidos_Paciente', 'usuarios_pacientes.Fecha_Nacimiento_Paciente', 'sexos.Sexo')
               ->join('sexos', 'sexos.id_Sexo','usuarios_pacientes.Sexo_id')
               ->where('usuarios_pacientes.id_Paciente',$paciente)
               ->first();
        }  
        $antecedentes= Antecedente::where('Paciente_Id', $paciente)->first();     
      }else{
        $datos= 'No tiene cita hoy a esta hora';
      }

      return response()->json([$datos, $antecedentes]);
    }
}

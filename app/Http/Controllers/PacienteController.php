<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use Illuminate\Support\Facades\Hash;
use App\Model\UsuarioP;
use App\Model\LoginP;
use App\User;
use App\Model\Pais;
use App\Model\Sexo;
use App\Model\PrefijoDNI;
use App\Model\Civil;
use App\Model\Status;
use App\Model\HistoricoP;
use App\Model\Ciudad;
use App\Model\Estado;
use App\Model\Municipio;
use App\Model\Parroquia;
use App\Limite;
use App\Model\DireccionPaciente;
use Flash;
use DB;

class PacienteController extends Controller
{
  public function volver()
  {
    return view('welcome');
  }
  public function create()
  {
      $sexo=Collection::make(Sexo::select(['id_Sexo','Sexo'])->orderBy('Sexo')->get())->pluck("Sexo", "id_Sexo");
      $prefijo=Collection::make(PrefijoDNI::select(['id_Prefijo_CIDNI','Prefijo_CIDNI'])->orderBy('Prefijo_CIDNI')->get())->pluck("Prefijo_CIDNI", "id_Prefijo_CIDNI");
      $estadoC=Collection::make(Civil::select(['id_Civil','Civil'])->orderBy('Civil')->get())->pluck("Civil", "id_Civil");
      $status=Collection::make(Status::select(['id_Status','Status'])->orderBy('Status')->get())->pluck("Status", "id_Status");
      $nacionalidad = Collection::make(Pais::select(['id_Pais','Pais'])->orderBy('Pais')->get())->pluck("Pais", "id_Pais");

      $ciudad=Collection::make(Ciudad::select(['id_Ciudad','Ciudad'])->orderBy('Ciudad')->get())->pluck("Ciudad", "id_Ciudad"); 
      $estado=Collection::make(Estado::select(['id_Estado','Estado'])->orderBy('Estado')->get())->pluck("Estado", "id_Estado"); 
      $municipio=Collection::make(Municipio::select(['id_Municipio','Municipio'])->orderBy('Municipio')->get())->pluck("Municipio", "id_Municipio"); 
      $parroquia=Collection::make(Parroquia::select(['id_Parroquia','Parroquia'])->orderBy('Parroquia')->get())->pluck("Parroquia", "id_Parroquia"); 

        return view('paciente.create')->with(compact('sexo','prefijo','estadoC','status','nacionalidad','ciudad','estado','municipio','parroquia')); 
    }

    public function add(Request $request)
    {
      $total = UsuarioP::where('Status_id',1)->count();
      $limite = Limite::select('paciente')->where('status',1)->first();
      if(!isset($limite)){
        Flash::error('Ocurrió un error, se debe agregar un limite de usuarios');
        return redirect()->route('paciente.volver');
      }
      if($total < $limite->paciente){
       
        try {
            $paciente= new UsuarioP();
            $paciente->Nombres_Paciente = ucfirst($request['nombre']);
            $paciente->Apellidos_Paciente = ucfirst($request['apellido']);
            $paciente->Prefijo_CIDNI_id = $request['prefijo'];
            $paciente->CIDNI = $request['cedula'];
            $paciente->Fecha_Nacimiento_Paciente = $request['fechNacP'];
            $paciente->Sexo_id = $request['sexo'];
            $paciente->Status_id = 1;
            $paciente->Civil_id = $request['civil'];
            $paciente->Pais_id = $request['nacionalidad'];
            $paciente->save();            

            Flash::success("Registro Agregado Correctamente");
         
        return redirect()->route('paciente.edit', $paciente->id);
         
        }catch (\Illuminate\Database\QueryException $e) {
         
            Flash::error('Ocurrió un error, por favor intente de nuevo');
            return redirect()->route('paciente.create');
        }
      }
    }

    public function edit($id)
    {
      $login = LoginP::where('id_login_Pacientes', $id)->first();
      $direccion = DireccionPaciente::where('Paciente_id', $id)->first();
      
      $paciente = UsuarioP::where('id_Paciente',$id)->first();
      $sexo=Collection::make(Sexo::select(['id_Sexo','Sexo'])->orderBy('Sexo')->get())->pluck("Sexo", "id_Sexo");
      $prefijo=Collection::make(PrefijoDNI::select(['id_Prefijo_CIDNI','Prefijo_CIDNI'])->orderBy('Prefijo_CIDNI')->get())->pluck("Prefijo_CIDNI", "id_Prefijo_CIDNI");
      $estadoC=Collection::make(Civil::select(['id_Civil','Civil'])->orderBy('Civil')->get())->pluck("Civil", "id_Civil");
      $status=Collection::make(Status::select(['id_Status','Status'])->orderBy('Status')->get())->pluck("Status", "id_Status");
      $nacionalidad = Collection::make(Pais::select(['id_Pais','Pais'])->orderBy('Pais')->get())->pluck("Pais", "id_Pais");

      $ciudad=Collection::make(Ciudad::select(['id_Ciudad','Ciudad'])->orderBy('Ciudad')->get())->pluck("Ciudad", "id_Ciudad"); 
      $estado=Collection::make(Estado::select(['id_Estado','Estado'])->orderBy('Estado')->get())->pluck("Estado", "id_Estado"); 
      $municipio=Collection::make(Municipio::select(['id_Municipio','Municipio'])->orderBy('Municipio')->get())->pluck("Municipio", "id_Municipio"); 
      $parroquia=Collection::make(Parroquia::select(['id_Parroquia','Parroquia'])->orderBy('Parroquia')->get())->pluck("Parroquia", "id_Parroquia"); 

      return view('paciente.edit')->with(compact('paciente','sexo','prefijo','estadoC','status','nacionalidad','login','ciudad','estado','municipio','parroquia','direccion')); 
         
    }

  public function login(Request $request)
  {
        DB::beginTransaction();
      try {
            $login= new LoginP();
            $login->Paciente_id = $request['id'];
            $login->Usuario = ucfirst($request['nombre_usuario']);
            $login->Correo = $request['correo'];
            $login->Status_id = $request['status'];
            $login->Contrasena = Hash::make($request['contrasena']);
            $login->save();

            $login2= new User();
            $login2->name = ucfirst($request['nombre_usuario']);
            $login2->email = $request['correo'];
            $login2->password = Hash::make($request['contrasena']);
            $login2->status = $request['status'];
            $login2->id_usuarioP = $request['id'];
            $login2->save();

            $login2->assignRole('Paciente');
          DB::commit();
          Flash::success("Registro Agregado Correctamente, ahora puede ingresar al sistema")->important();            
            return redirect()->route('login');
        }catch(\Illuminate\Database\QueryException $e) {
          DB::rollback();
            Flash::error('Ocurrió un error, por favor intente de nuevo');
            return redirect()->route('paciente.edit', $request['id']);  
        }

  }

  public function direccion(Request $request)
    {
        try {
            $direccion= new DireccionPaciente();
            $direccion->Paciente_id = $request['idP'];
            $direccion->Direccion = ucfirst($request['direccion']);
            $direccion->Numero_Casa = $request['ncasa'];
            $direccion->Telefono = $request['telefono'];
            $direccion->Celular = $request['celular'];
            $direccion->Correo = $request['correo'];
            $direccion->Cuidad_id = $request['ciudad'];
            $direccion->Estado_id = $request['estado'];
            $direccion->Municipio_id = $request['municipio'];
            $direccion->Parroquia_id = $request['parroquia'];
            $direccion->save();            
            
            Flash::success("Registro Agregado Correctamente");            
        } catch (\Illuminate\Database\QueryException $e) {
            Flash::error('Ocurrió un error, por favor intente de nuevo');
        }
        return redirect()->route('paciente.edit', $request['idP']);
    }
}

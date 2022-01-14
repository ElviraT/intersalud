<?php

namespace App\Http\Controllers\Admin\configuracion\usuarios;

use App\Http\Controllers\Controller;
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
use App\Model\DireccionPaciente;
use Spatie\Permission\Models\Role;
use Flash;
use DB;

class UsuarioPController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:usuario_p')->only('index');
      $this->middleware('can:usuario_p.add')->only('add');
      $this->middleware('can:usuario_p.edit')->only('edit','update');
      $this->middleware('can:usuario_p.destroy')->only('destroy');
    }

     public function index(UsuarioP $model)
  	{  
      session()->forget('id_pariente');
    if(auth()->user()->name == 'Admin'){
      $usuariosP = UsuarioP::all();
    }else{
      $usuariosP = UsuarioP::where('id_Paciente', auth()->user()->id_usuarioP)->get();
    }
  		return view('admin.configuracion.usuarios.usuariosP.index', ['usuariosP' => $usuariosP]);
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

    	return view('admin.configuracion.usuarios.usuariosP.create')->with(compact('sexo','prefijo','estadoC','status','nacionalidad','ciudad','estado','municipio','parroquia')); 
  	}

  	 public function add(Request $request)
    {
    	if($request->id == null){
        try {
            $paciente= new UsuarioP();
            $paciente->Nombres_Paciente = ucfirst($request['nombre']);
            $paciente->Apellidos_Paciente = ucfirst($request['apellido']);
            $paciente->Prefijo_CIDNI_id = $request['prefijo'];
            $paciente->CIDNI = $request['cedula'];
            $paciente->Fecha_Nacimiento_Paciente = $request['fechNacP'];
            $paciente->Sexo_id = $request['sexo'];
            $paciente->Status_id = $request['status'];
            $paciente->Civil_id = $request['civil'];
            $paciente->Pais_id = $request['nacionalidad'];
            $paciente->save();

        //dd($Paciente->id);
            

            Flash::success("Registro Agregado Correctamente");            
        return redirect()->route('usuario_p.edit', $paciente->id);
        } catch (\Illuminate\Database\QueryException $e) {
            Flash::error('Ocurrió un error, por favor intente de nuevo');
            return redirect()->route('usuario_p.create');
        }
      }else{
        try{
                $id = (int)$request->id;
                 UsuarioP::where('id_Paciente', $id)->update([
                'Nombres_Paciente' => ucfirst($request['nombre']),
                'Apellidos_Paciente' => ucfirst($request['apellido']),
                'Prefijo_CIDNI_id' => $request['prefijo'],
                'CIDNI' => $request['cedula'],
                'Fecha_Nacimiento_Paciente' => $request['fechNacP'],
                'Sexo_id' => $request['sexo'],
                'Status_id' => $request['status'],
                'Civil_id' => $request['civil'],
                'Pais_id' => $request['nacionalidad'],
                ]);

                 $login = LoginP::where('id_login_Pacientes', $id)->first();
                 if (isset($login)) {
                  LoginP::where('id_login_Pacientes', $id)->update([
                  'Status_id' => $request['status'],
                  ]);

                  User::where('id_usuarioP', $id)->update([
                  'status' => $request['status']
                  ]);
                 }

                Flash::success("Registro Actualizado Correctamente");

            }catch(\Illuminate\Database\QueryException $e) {
              Flash::error('Ocurrió un error, por favor intente de nuevo'); 
            }
            return redirect()->route('usuario_p.edit', $id);
      }
    }

    public function edit($id)
    {
      $login = LoginP::where('id_login_Pacientes', $id)->first();
      $direccion= DireccionPaciente::where('Paciente_id', $id)->first();
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

      return view('admin.configuracion.usuarios.usuariosP.edit')->with(compact('paciente','sexo','prefijo','estadoC','status','nacionalidad','login','ciudad','estado','municipio','parroquia','direccion')); 
    }

    public function login(Request $request)
  {
    if($request->idL == null){
       DB::beginTransaction();
      try {
            $login= new LoginP();
            $login->Paciente_id = $request['id'];
            $login->Usuario = ucfirst($request['nombre_usuario']);
            $login->Correo = $request['correo'];
            $login->Status_id = 1;
            $login->Contrasena = Hash::make($request['contrasena']);
            $login->save();

            $login2= new User();
            $login2->name = ucfirst($request['nombre_usuario']);
            $login2->email = $request['correo'];
            $login2->password = Hash::make($request['contrasena']);
            $login2->status = 1;
            $login2->id_usuarioP = $request['id'];
            $login2->save();

            $login2->assignRole('Paciente');
            DB::commit();
        Flash::success("Registro Agregado Correctamente");            
        } catch (\Illuminate\Database\QueryException $e) {
          DB::rollback();
            Flash::error('Ocurrió un error, por favor intente de nuevo');  
        }

        return redirect()->route('usuario_p.edit', $request['id']);
    }else{
      
          $id = (int)$request->id;
          $login= LoginP::where('Paciente_id', $id)->first();
          $login_rol= User::where('id_usuarioP', $id)->first();
          $fecha= date('Y-m-d');
//dd($login);

           if(password_verify($request['contrasena'], $login->password)){
            Flash::error('Debe ingresar una contraseña distinta a las anterior');
            return redirect()->route('usuario_p.edit', $id);
           }else{
             DB::beginTransaction();
            try{
                    LoginP::where('Paciente_id', $id)->update([
                    'Usuario' => ucfirst($request['nombre_usuario']),
                    'Correo' => $request['correo'],
                    'Status_id' => $request['status'],
                    'Contrasena' => Hash::make($request['contrasena']),
                    ]);

                    User::where('id_usuarioP', $id)->update([
                    'name' => ucfirst($request['nombre_usuario']),
                    'email' => $request['correo'],
                    'password' => Hash::make($request['contrasena']),
                    'status' => $request['status']
                    ]);

                $rolesToRemove = array('Médico', 'Admin','Asistente','Paciente');
               if(isset($login->roles()->first()->name)){
                  foreach ($rolesToRemove as $role) {
                     $login->removeRole($role);
                  }             
                }
                    
                  $login_rol->assignRole('Paciente');
                  $loginh= new HistoricoP();
                  $loginh->Login_Pacientes_id = $login->Paciente_id;
                  $loginh->Old_contrasena = Hash::make($login->password);
                  $loginh->Fecha = $fecha;
                  $loginh->Paciente_id = $id;
                  $loginh->Correo = $login->email;
                  $loginh->Nota = '';
                  $loginh->save();
                DB::commit();
                    Flash::success("Registro Actualizado Correctamente");

                }catch(\Illuminate\Database\QueryException $e) {
                  DB::rollback();
                  Flash::error('Ocurrió un error, por favor intente de nuevo'); 
                }
                return redirect()->route('usuario_p.edit', $id);
          }
    }
  }

  public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       UsuarioP::where('id_Paciente', $id)->update(['Status_id' => 2]);
       User::where('id_usuarioP', $id)->update(['status' => 0]);

       Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('usuario_p');
    }
}

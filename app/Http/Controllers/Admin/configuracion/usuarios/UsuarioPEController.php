<?php

namespace App\Http\Controllers\Admin\configuracion\usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use Illuminate\Support\Facades\Hash;
use App\Model\UsuarioPE;
use App\Model\Pais;
use App\Model\Sexo;
use App\Model\PrefijoDNI;
use App\Model\Civil;
use App\Model\Status;
use Flash;

class UsuarioPEController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:usuario_pe')->only('index');
      $this->middleware('can:usuario_pe.add')->only('add','agregar');
      $this->middleware('can:usuario_pe.edit')->only('edit','update');
      $this->middleware('can:usuario_pe.destroy')->only('destroy');
    }

    public function index($id)
  	{   
  		$usuariosPEs= UsuarioPE::where('Paciente_id',$id)->get();	
  		return view('admin.configuracion.usuarios.usuariosPE.index', ['usuariosPE' => $usuariosPEs,'id'=>$id]);
  	}

  	public function agregar($idp)
  	{
    	$sexo=Collection::make(Sexo::select(['id_Sexo','Sexo'])->orderBy('Sexo')->get())->pluck("Sexo", "id_Sexo");
    	$prefijo=Collection::make(PrefijoDNI::select(['id_Prefijo_CIDNI','Prefijo_CIDNI'])->orderBy('Prefijo_CIDNI')->get())->pluck("Prefijo_CIDNI", "id_Prefijo_CIDNI");
    	$estadoC=Collection::make(Civil::select(['id_Civil','Civil'])->orderBy('Civil')->get())->pluck("Civil", "id_Civil");
    	$status=Collection::make(Status::select(['id_Status','Status'])->orderBy('Status')->get())->pluck("Status", "id_Status");
    	$nacionalidad = Collection::make(Pais::select(['id_Pais','Pais'])->orderBy('Pais')->get())->pluck("Pais", "id_Pais");

    	return view('admin.configuracion.usuarios.usuariosPE.create')->with(compact('sexo','prefijo','estadoC','status','nacionalidad','idp')); 
  	}

  	 public function add(Request $request)
    {
    	if ($request->pi == 'on') {
    		$infantil = 1;
    	}else{
    		$infantil = 0;
    	}
    	if ($request->pm == 'on') {
    		$mayor = 1;
    	}else{
    		$mayor = 0;
    	}
    	if ($request->pd == 'on') {
    		$discapacidad = 1;
    	}else{
    		$discapacidad = 0;
    	}
    	if($request->id == null){
        try {
            $pacienteE= new UsuarioPE();
            $pacienteE->Paciente_id = $request['idP'];
            $pacienteE->Nombre_Paciente_Especial = ucfirst($request['nombre']);
            $pacienteE->Apellido_Paciente_Especial = ucfirst($request['apellido']);
            $pacienteE->Fecha_Nacimiento_Paciente_Especial = $request['fechNacP'];
            $pacienteE->Sexo_id = $request['sexo'];
            $pacienteE->Parentesco_Familiar = ucfirst($request['parentesco']);
            $pacienteE->Prefijo_CIDNI_id = $request['prefijo'];
            $pacienteE->CIDNI = $request['cedula'];
            $pacienteE->Status_id = $request['status'];
            $pacienteE->Paciente_Infantil = $infantil;
            $pacienteE->Paciente_Mayor = $mayor;
            $pacienteE->Paciente_Discapacidad = $discapacidad;
            $pacienteE->Nota = $request['nota'];
            $pacienteE->Civil_id = $request['civil'];
            $pacienteE->Pais_id = $request['nacionalidad'];
            $pacienteE->save();
            

            Flash::success("Registro Agregado Correctamente");            
        return redirect()->route('usuario_pe.edit', $pacienteE->id);
        } catch (\Illuminate\Database\QueryException $e) {
            Flash::error($e.'Ocurrió un error, por favor intente de nuevo');
            return redirect()->route('usuario_pe.agregar', $request->idP);
        }
      }else{
        try{
                $id = (int)$request->id;
                 UsuarioPE::where('id_Pacientes_Especiales', $id)->update([
                'Nombre_Paciente_Especial' => ucfirst($request['nombre']),
                'Apellido_Paciente_Especial' => ucfirst($request['apellido']),
                'Fecha_Nacimiento_Paciente_Especial' => $request['fechNacPE'],
                'Sexo_id' => $request['sexo'],
                'Parentesco_Familiar' => ucfirst($request['parentesco']),
                'Prefijo_CIDNI_id' => $request['prefijo'],
                'CIDNI' => $request['cedula'],
                'Status_id' => $request['status'],
                'Paciente_Infantil' => $request['status'],
                'Paciente_Mayor' => $request['status'],
                'Paciente_Discapacidad' => $request['status'],
                'Nota' => $request['nota'],
                'Civil_id' => $request['civil'],
                'Pais_id' => $request['nacionalidad'],
                ]);

                 $login = LoginP::where('id_login_Pacientes', $id)->first();
                 if (isset($login)) {
                  LoginP::where('id_login_Pacientes', $id)->update([
                  'Status_id' => $request['status'],
                  ]);

                  User::where('id_UsuarioPE', $id)->update([
                  'status' => $request['status']
                  ]);
                 }

                Flash::success("Registro Actualizado Correctamente");

            }catch(\Illuminate\Database\QueryException $e) {
              Flash::error('Ocurrió un error, por favor intente de nuevo'); 
            }
            return redirect()->route('usuario_pe.edit', $id);
      }
    }

    public function edit($id)
    {
      $paciente = UsuarioPE::where('id_Pacientes_Especiales',$id)->first();
      $sexo=Collection::make(Sexo::select(['id_Sexo','Sexo'])->orderBy('Sexo')->get())->pluck("Sexo", "id_Sexo");
      $prefijo=Collection::make(PrefijoDNI::select(['id_Prefijo_CIDNI','Prefijo_CIDNI'])->orderBy('Prefijo_CIDNI')->get())->pluck("Prefijo_CIDNI", "id_Prefijo_CIDNI");
      $estadoC=Collection::make(Civil::select(['id_Civil','Civil'])->orderBy('Civil')->get())->pluck("Civil", "id_Civil");
      $status=Collection::make(Status::select(['id_Status','Status'])->orderBy('Status')->get())->pluck("Status", "id_Status");
      $nacionalidad = Collection::make(Pais::select(['id_Pais','Pais'])->orderBy('Pais')->get())->pluck("Pais", "id_Pais");

      return view('admin.configuracion.usuarios.usuariosPE.edit')->with(compact('paciente','sexo','prefijo','estadoC','status','nacionalidad')); 
    }

    public function login(Request $request)
  {
    if($request->idL == null){
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
            $login2->id_UsuarioPE = $request['id'];
            $login2->save();

            $login2->assignRole('Paciente');

        Flash::success("Registro Agregado Correctamente");            
        } catch (\Illuminate\Database\QueryException $e) {
            Flash::error('Ocurrió un error, por favor intente de nuevo');  
        }

        return redirect()->route('usuario_pe.edit', $request['id']);
    }else{
      
          $id = (int)$request->id;
          $login= LoginP::where('Paciente_id', $id)->first();
          $login_rol= User::where('id_UsuarioPE', $id)->first();
          $fecha= date('Y-m-d');
//dd($login);

           if(password_verify($request['contrasena'], $login->password)){
            Flash::error('Debe ingresar una contraseña distinta a las anterior');
            return redirect()->route('usuario_pe.edit', $id);
           }else{
            try{
                    LoginP::where('Paciente_id', $id)->update([
                    'Usuario' => ucfirst($request['nombre_usuario']),
                    'Correo' => $request['correo'],
                    'Status_id' => $request['status'],
                    'Contrasena' => Hash::make($request['contrasena']),
                    ]);

                    User::where('id_UsuarioPE', $id)->update([
                    'name' => ucfirst($request['nombre_usuario']),
                    'email' => $request['correo'],
                    'password' => Hash::make($request['contrasena']),
                    'status' => $request['status']
                    ]);

                $rolesToRemove = array('Médico', 'Admin','Asistente','Paciente');
                foreach ($rolesToRemove as $role) {
                   $login_rol->removeRole($role);
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

                    Flash::success("Registro Actualizado Correctamente");

                }catch(\Illuminate\Database\QueryException $e) {
                  Flash::error($e.'Ocurrió un error, por favor intente de nuevo'); 
                }
                return redirect()->route('usuario_pe.edit', $id);
          }
    }
  }

  public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       UsuarioPE::where('id_Pacientes_Especiales', $id)->update(['Status_id' => 2]);
       User::where('id_UsuarioPE', $id)->update(['status' => 0]);

       Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('usuario_pe');
    }
}

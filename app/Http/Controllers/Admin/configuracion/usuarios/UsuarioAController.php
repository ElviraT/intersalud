<?php

namespace App\Http\Controllers\Admin\configuracion\usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use Illuminate\Support\Facades\Hash;
use App\Model\UsuarioA;
use App\Model\UsuarioM;
use App\Model\LoginT;
use App\User;
use App\Model\Pais;
use App\Model\Sexo;
use App\Model\PrefijoDNI;
use App\Model\Civil;
use App\Model\Status;
use App\Model\HistoricoT;
use Spatie\Permission\Models\Role;
use Flash;
use DB;

class UsuarioAController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:usuario_a')->only('index');
      $this->middleware('can:usuario_a.add')->only('add');
      $this->middleware('can:usuario_a.edit')->only('edit','update');
      $this->middleware('can:usuario_a.destroy')->only('destroy');
    }

     public function index(UsuarioA $model)
  	{  
    if(auth()->user()->name == 'Admin'){
        $usuariosA = UsuarioA::all();
    }else{
        $usuariosA = UsuarioA::where('id_Medico', auth()->user()->id_usuario)->get();
    }  	
  		return view('admin.configuracion.usuarios.usuariosA.index', ['usuariosA' => $usuariosA]);
  	}

  	public function create()
  	{
    	$medicos= Collection::make(UsuarioM::select(['usuarios_medicos.id_Medico',DB::raw('CONCAT(usuarios_medicos.Nombres_Medico, " ", usuarios_medicos.Apellidos_Medicos) AS Nombre')])->leftjoin('usuarios_asistentes', 'usuarios_asistentes.id_Medico', '=' ,'usuarios_medicos.id_Medico')->whereNull('usuarios_asistentes.id_Medico')->orderBy('Nombres_Medico')->get())->pluck("Nombre", "id_Medico");

    	$sexo=Collection::make(Sexo::select(['id_Sexo','Sexo'])->orderBy('Sexo')->get())->pluck("Sexo", "id_Sexo");
    	$prefijo=Collection::make(PrefijoDNI::select(['id_Prefijo_CIDNI','Prefijo_CIDNI'])->orderBy('Prefijo_CIDNI')->get())->pluck("Prefijo_CIDNI", "id_Prefijo_CIDNI");
    	$estadoC=Collection::make(Civil::select(['id_Civil','Civil'])->orderBy('Civil')->get())->pluck("Civil", "id_Civil");
    	$status=Collection::make(Status::select(['id_Status','Status'])->orderBy('Status')->get())->pluck("Status", "id_Status");
    	$nacionalidad = Collection::make(Pais::select(['id_Pais','Pais'])->orderBy('Pais')->get())->pluck("Pais", "id_Pais");
    	$roles = Collection::make(Role::select(['id','name'])->orderBy('name')->get())->pluck("name", "id");

    	return view('admin.configuracion.usuarios.usuariosA.create')->with(compact('sexo','prefijo','estadoC','status','nacionalidad','roles','medicos')); 
  	}

    public function add(Request $request)
    {
    	if($request->id == null){
        try {
            $asistente= new UsuarioA();
            $asistente->Nombre_Asistente = ucfirst($request['nombre']);
            $asistente->Prefijo_CIDNI_id = $request['prefijo'];
            $asistente->Apellidos_Asistente = ucfirst($request['apellido']);
            $asistente->CIDNI = $request['cedula'];
            $asistente->Sexo_id = $request['sexo'];
            $asistente->Fecha_Nacimiento_Asistente = $request['fechNacA'];
            $asistente->Status_id = $request['status'];
            $asistente->Civil_id = $request['civil'];
            $asistente->Pais_id = $request['nacionalidad'];
            $asistente->id_Medico = $request['id_medico'];
            $asistente->save();

        //dd($asistente->id);
            

            Flash::success("Registro Agregado Correctamente");            
        return redirect()->route('usuario_a.edit', $asistente->id);
        } catch (\Illuminate\Database\QueryException $e) {
            Flash::error('Ocurrió un error, por favor intente de nuevo');
            return redirect()->route('usuario_a.create');
        }
      }else{
        try{
                $id = (int)$request->id;
                 UsuarioA::where('id_asistente', $id)->update([
                'Nombre_Asistente' => ucfirst($request['nombre']),
                'Prefijo_CIDNI_id' => $request['prefijo'],
                'Apellidos_Asistente' => ucfirst($request['apellido']),
                'CIDNI' => $request['cedula'],
                'Sexo_id' => $request['sexo'],
                'Fecha_Nacimiento_Asistente' => $request['fechNacA'],
                'Status_id' => $request['status'],
                'Civil_id' => $request['civil'],
                'Pais_id' => $request['nacionalidad'],
                'id_Medico' => $request['id_medico'],
                ]);

                 $login = LoginT::where('Asistente_id', $id)->first();
                 if (isset($login)) {
                  LoginT::where('Asistente_id', $id)->update([
                  'Status_Medico_id' => $request['status'],
                  ]);

                  User::where('id_usuarioA', $id)->update([
                  'status' => $request['status']
                  ]);
                 }

                Flash::success("Registro Actualizado Correctamente");

            }catch(\Illuminate\Database\QueryException $e) {
              Flash::error('Ocurrió un error, por favor intente de nuevo'); 
            }
            return redirect()->route('usuario_a.edit', $id);
      }
    }

    public function edit($id)
    {
      $login = LoginT::where('Asistente_id', $id)->first();
      $rol = DB::select("SELECT m.role_id FROM model_has_roles as m, users as u WHERE m.model_id = u.id and u.id_usuario ='$id'");

      $asistente = UsuarioA::where('id_asistente',$id)->first();
      $medicos=Collection::make(UsuarioM::select(['id_Medico', DB::raw('CONCAT(Nombres_Medico, " ", Apellidos_Medicos) AS Nombre')])->orderBy('Nombres_Medico')->get())->pluck("Nombre", "id_Medico");
      $sexo=Collection::make(Sexo::select(['id_Sexo','Sexo'])->orderBy('Sexo')->get())->pluck("Sexo", "id_Sexo");
      $prefijo=Collection::make(PrefijoDNI::select(['id_Prefijo_CIDNI','Prefijo_CIDNI'])->orderBy('Prefijo_CIDNI')->get())->pluck("Prefijo_CIDNI", "id_Prefijo_CIDNI");
      $estadoC=Collection::make(Civil::select(['id_Civil','Civil'])->orderBy('Civil')->get())->pluck("Civil", "id_Civil");
      $status=Collection::make(Status::select(['id_Status','Status'])->orderBy('Status')->get())->pluck("Status", "id_Status");
      $nacionalidad = Collection::make(Pais::select(['id_Pais','Pais'])->orderBy('Pais')->get())->pluck("Pais", "id_Pais");
      $roles = Collection::make(Role::select(['id','name'])->orderBy('name')->get())->pluck("name", "id");

      return view('admin.configuracion.usuarios.usuariosA.edit')->with(compact('asistente','sexo','prefijo','estadoC','status','nacionalidad','roles','medicos','login','rol')); 
    }

  public function login(Request $request)
  {
    if($request->idL == null){
      try {
            $login= new LoginT();
            $login->Usuario = ucfirst($request['nombre_usuario']);
            $login->Correo = $request['correo'];
            $login->Status_Medico_id = $request['status'];
            $login->Contrasena = Hash::make($request['contrasena']);
            $login->Asistente_id = $request['id'];
            $login->save();

            $login2= new User();
            $login2->name = ucfirst($request['nombre_usuario']);
            $login2->email = $request['correo'];
            $login2->password = Hash::make($request['contrasena']);
            $login2->status = $request['status'];
            $login2->id_usuarioA = $request['id'];
            $login2->save();

            $login2->assignRole('Asistente');

        Flash::success("Registro Agregado Correctamente");            
        } catch (\Illuminate\Database\QueryException $e) {
            Flash::error($e->getMessage().'Ocurrió un error, por favor intente de nuevo');  
        }

        return redirect()->route('usuario_a.edit', $request['id']);
    }else{
      
          $id = (int)$request->id;
          $login= User::where('id_usuarioA', $id)->first();
          $fecha= date('Y-m-d');

           if(password_verify($request['contrasena'], $login->password)){
            Flash::error('Debe ingresar una contraseña distinta a las anterior');
            return redirect()->route('usuario_a.edit', $id);
           }else{
            try{
                    LoginT::where('Asistente_id', $id)->update([
                    'Usuario' => ucfirst($request['nombre_usuario']),
                    'Correo' => $request['correo'],
                    'Status_Medico_id' => $request['status'],
                    'Contrasena' => Hash::make($request['contrasena'])
                    ]);

                    User::where('id_usuarioA', $id)->update([
                    'name' => ucfirst($request['nombre_usuario']),
                    'email' => $request['correo'],
                    'password' => Hash::make($request['contrasena']),
                    'status' => $request['status']
                    ])->assignRole($request['rol']);

                
                    $loginT = LoginT::where('Asistente_id', $id)->first();
                  $loginh= new HistoricoT();
                  $loginh->Login_Tranajador_id = $loginT->id_Login_Trabajador;
                  $loginh->Old_Constrasena = Hash::make($login->password);
                  $loginh->Fecha = $fecha;
                  $loginh->Asistente_id = $id;
                  $loginh->Correo = $login->email;
                  $loginh->Nota = '';
                  $loginh->save();

                    Flash::success("Registro Actualizado Correctamente");

                }catch(\Illuminate\Database\QueryException $e) {
                  Flash::error($e->getMessage().'Ocurrió un error, por favor intente de nuevo'); 
                }
                return redirect()->route('usuario_a.edit', $id);
          }
    }
  }

  public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       UsuarioA::where('id_asistente', $id)->update(['Status_id' => 2]);
       User::where('id_usuarioA', $id)->update(['status' => 0]);

       Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('usuario_a');
    }
}

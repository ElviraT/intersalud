<?php

namespace App\Http\Controllers\Admin\configuracion\usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use App\Model\UsuarioM;
use App\Model\LoginT;
use App\Model\Seniat;
use App\User;
use App\Model\Pais;
use Session;
use Flash;

class UsuarioMController extends Controller
{
    public function index(UsuarioM $model)
  	{   
  		Session::put('medico', null); 	
  		return view('admin.configuracion.usuarios.usuariosM.index', ['usuariosM' => $model->all()]);
  	}

  	public function create()
  	{
    	$sexo=['1'=> 'Mujer','2'=> 'Hombre','3'=> 'Otro'];
    	$prefijo=['1'=> 'V-','2'=> 'E-','3'=> 'J-'];
    	$estadoC=['1'=> 'Soltero(a)','2'=> 'Casado(a)','3'=> 'Divorciado(a)','4'=> 'Viudo(a)','5'=> 'Otro'];
    	$nacionalidad = Collection::make(Pais::select(['id_Pais','Pais'])->orderBy('Pais')->get())->pluck("Pais", "id_Pais");

    	return view('admin.configuracion.usuarios.usuariosM.create')->with(compact('sexo', 'prefijo', 'estadoC', 'nacionalidad')); 
  	}
	public function add(Request $request)
	{
	  	try {
	        $medico= new UsuarioM();
	        $medico->Nombres_Medico = ucfirst($request['nombre']);
	        $medico->Prefijo_CIDNI_id = $request['prefijo'];
	        $medico->Apellidos_Medicos = ucfirst($request['apellido']);
	        $medico->CIDNI = $request['cedula'];
	        $medico->Fecha_Nacimiento_Medico = $request['fechNac'];
	        $medico->Sexo_id = $request['sexo'];
	        $medico->Registro_MPPS = $request['registro'];
	        $medico->Numero_Colegio_de_Medico = $request['ncm'];
	        $medico->Status_Medico_id = 1;
	        $medico->Civil_id = $request['civil'];
	        $medico->Pais_id = $request['nacionalidad'];
	        $medico->save();
	        Session::put('medico', $medico);

	        Flash::success("Registro Agregado Correctamente");            
	    } catch (\Illuminate\Database\QueryException $e) {
	        Flash::error('Ocurrió un error, por favor intente de nuevo');    
	    }

	    return redirect()->route('usuario_m.create');

	}
	public function login(Request $request)
	{
		try {
	        $login= new LoginT();
	        $login->Usuario = ucfirst($request['nombre_usuario']);
	        $login->Correo = $request['correo'];
	        $login->Status_Medico_id = $request['id'];
	        $login->Contrasena = Hash::make($request['contrasena']);
	        $login->Nivel = $request['nivel'];
	        $login->save();

	        $login2= new User();
	        $login2->name = ucfirst($request['nombre_usuario']);
	        $login2->email = $request['correo'];
	        $login2->password = Hash::make($request['contrasena']);
	        $login2->status = 1;
	        $login2->id_usuario = $request['id'];
	        $login2->save();

			Flash::success("Registro Agregado Correctamente");            
	    } catch (\Illuminate\Database\QueryException $e) {
	        Flash::error('Ocurrió un error, por favor intente de nuevo');    
	    }

	    return redirect()->route('usuario_m.create');
	}

	public function seniat(Request $request)
	{
		try {
	        $seniat= new Seniat();
	        $seniat->RIF = $request['rif'];
	        $seniat->Direccion = $request['direccion'];
	        $seniat->Medico_id = $request['id'];
	        $seniat->Fecha = $request['fecha'];
	        $seniat->save();

			Flash::success("Registro Agregado Correctamente");            
	    } catch (\Illuminate\Database\QueryException $e) {
	        Flash::error('Ocurrió un error, por favor intente de nuevo');    
	    }

	    return redirect()->route('usuario_m.create');
	}

	public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $usuariom= UsuarioM::where('id_Medico', $id)->delete();
       $logint= LoginT::where('Status_Medico_id', $id)->delete();
       $usuario= User::where('id_usuario', $id)->delete();
       $seniat= Seniat::where('Medico_id', $id)->delete();
        
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('usuario_m.create');
    }
}

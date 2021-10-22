<?php

namespace App\Http\Controllers\Admin\configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Sexo;
use Flash;

class SexoController extends Controller
{
    public function index(Sexo $model)
  	{    	
  		return view('admin.configuracion.sexos.index', ['sexos' => $model->all()]);
  	}
  	public function add (Request $request)
    {   
  
       if($request->id == 0){
            try {
                $sex= new Sexo();
                $sex->Sexo = ucfirst($request['nombre']);
                $sex->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error('Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 Sexo::where('id_Sexo', $id)->update([
                    'Sexo'=>ucfirst($request->nombre),
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('sexo');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $sexes= Sexo::where('id_Sexo','=', $id)->first();
        return response()->json([$sexes]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $sexes= Sexo::where('id_Sexo', $id)->delete();
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('sexo');
    }
}

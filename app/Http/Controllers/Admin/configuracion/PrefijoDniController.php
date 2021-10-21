<?php

namespace App\Http\Controllers\Admin\configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PrefijoDNI;
use Flash;

class PrefijoDniController extends Controller
{
     public function index(PrefijoDNI $model)
  	{    	
  		return view('admin.configuracion.prefijos.index', ['prefijos' => $model->all()]);
  	}
  	public function add (Request $request)
    {   
  
       if($request->id == 0){
            try {
                $prefix= new PrefijoDNI();
                $prefix->Prefijo_CIDNI = ucfirst($request['nombre']);
                $prefix->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error('Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 PrefijoDNI::where('id_Prefijo_CIDNI', $id)->update([
                    'Prefijo_CIDNI'=>ucfirst($request->nombre),
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('prefijo');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $prefixes= PrefijoDNI::where('id_Prefijo_CIDNI','=', $id)->first();
        return response()->json([$prefixes]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $prefixes= PrefijoDNI::where('id_Prefijo_CIDNI', $id)->delete();
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('prefijo');
    }
}

<?php

namespace App\Http\Controllers\Admin\configuracion\direccion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Estado;
use Flash;

class EstadoController extends Controller
{
  public function __construct()
    {
      $this->middleware('can:estado')->only('index');
      $this->middleware('can:estado.add')->only('add');
      $this->middleware('can:estado.edit')->only('edit');
    }
   public function index(Estado $model)
  	{    	
  		return view('admin.configuracion.direccion.estados.index', ['estados' => $model->all()]);
  	}
  	public function add (Request $request)
    {   
       if($request->id == 0){
            try {
                $state= new Estado();
                $state->Estado = ucfirst($request['nombre']);
                $state->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error('Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 Estado::where('id_Estado', $id)->update([
                    'Estado'=>ucfirst($request->nombre),
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('estado');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $states= Estado::where('id_Estado','=', $id)->first();

        return response()->json([$states]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $states= Estado::where('id_estado', $id)->delete();
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('estado');
    }

}

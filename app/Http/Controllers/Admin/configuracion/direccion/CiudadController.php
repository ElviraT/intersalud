<?php

namespace App\Http\Controllers\Admin\configuracion\direccion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use App\Model\Estado;
use App\Model\Ciudad;
use Flash;

class CiudadController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:ciudad')->only('index');
      $this->middleware('can:ciudad.add')->only('add');
      $this->middleware('can:ciudad.edit')->only('edit');
    }
     public function index(Ciudad $model)
  	{    	
  		$states= Collection::make(Estado::select(['id_Estado','Estado'])->orderBy('Estado')->get())->pluck("Estado", "id_Estado");
  		return view('admin.configuracion.direccion.ciudades.index', ['ciudades' => $model->all(), 'estados'=> $states]);
  	}
  	public function add (Request $request)
    {   
    	if ($request['capital'] == 'on') {
    		$capital = 1;
    	}else{
    		$capital = 0;
    	}
    	
       if($request->id == 0){
            try {
                $city= new Ciudad();
                $city->Estado_id = $request['estado'];
                $city->Ciudad = ucfirst($request['nombre']);
                $city->Capital = $capital;
                $city->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error('Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 Ciudad::where('id_Ciudad', $id)->update([
                    'Estado_id'=>$request->estado,
                    'Ciudad'=>ucfirst($request->nombre),
                    'Capital'=>$capital,
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('ciudad');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $cities= Ciudad::where('id_Ciudad','=', $id)->first();
        return response()->json([$cities]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $cities= Ciudad::where('id_Ciudad', $id)->delete();
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('ciudad');
    }
}

<?php

namespace App\Http\Controllers\Admin\configuracion\direccion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use App\Model\Municipio;
use App\Model\Estado;
use Flash;

class MunicipioController extends Controller
{
  public function __construct()
    {
      $this->middleware('can:municipio')->only('index');
      $this->middleware('can:municipio.add')->only('add');
      $this->middleware('can:municipio.edit')->only('edit');
    }
    public function index(Municipio $model)
  	{    	
  		$states= Collection::make(Estado::select(['id_Estado','Estado'])->orderBy('Estado')->get())->pluck("Estado", "id_Estado");
  		return view('admin.configuracion.direccion.municipios.index', ['municipios' => $model->all(), 'estados'=> $states]);
  	}
  	public function add (Request $request)
    {   
    	
       if($request->id == 0){
            try {
                $municipality= new Municipio();
                $municipality->Estado_id = $request['estado'];
                $municipality->Municipio = ucfirst($request['nombre']);
                $municipality->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error('Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 Municipio::where('id_Municipio', $id)->update([
                    'Estado_id'=>$request->estado,
                    'Municipio'=>ucfirst($request->nombre)
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('municipio');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $municipalities= Municipio::where('id_Municipio','=', $id)->first();
        return response()->json([$municipalities]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $municipalities= Municipio::where('id_Municipio', $id)->delete();
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('municipio');
    }
}

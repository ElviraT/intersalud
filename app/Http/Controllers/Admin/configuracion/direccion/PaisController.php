<?php

namespace App\Http\Controllers\Admin\configuracion\direccion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Pais;
use Flash;

class PaisController extends Controller
{
  public function __construct()
    {
      $this->middleware('can:pais')->only('index');
      $this->middleware('can:pais.add')->only('add');
      $this->middleware('can:pais.edit')->only('edit');
    }
    public function index(Pais $model)
  	{    	
  		return view('admin.configuracion.direccion.paises.index', ['paises' => $model->all()]);
  	}
  	public function add (Request $request)
    {   
       if($request->id == 0){
            try {
                $country= new Pais();
                $country->Codigo = $request['codigo'];
                $country->iso3166a1 = ucfirst($request['nombre']);
                $country->iso3166a2 = ucfirst($request['nombre2']);
                $country->Pais = ucfirst($request['pais']);
                $country->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error('Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 Pais::where('id_Pais', $id)->update([
                    'Codigo'=>$request->codigo,
                    'iso3166a1'=>ucfirst($request->nombre),
                    'iso3166a2'=>ucfirst($request->nombre2),
                    'Pais'=>ucfirst($request->pais),
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('pais');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $countries= Pais::where('id_Pais','=', $id)->first();

        return response()->json([$countries]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $countries= Pais::where('id_Pais', $id)->delete();
       Flash::success('Registro eliminado correctamente');
       
      return redirect()->route('pais');
    }

}

<?php

namespace App\Http\Controllers\Admin\configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\Request;
use App\Model\Banco;
use App\Model\Status;
use Flash;

class BancosController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:banco')->only('index');
      $this->middleware('can:banco.add')->only('add');
      $this->middleware('can:banco.edit')->only('edit');
      $this->middleware('can:banco.destroy')->only('destroy');
    }
    public function index(Banco $model)
  	{   
  		$status=Collection::make(Status::select(['id_Status','Status'])->orderBy('Status')->get())->pluck("Status", "id_Status"); 	
  		return view('admin.configuracion.bancos.index', ['bancos' => $model->all(),'status'=>$status]);
  	}
  	public function add (Request $request)
    {   
  
       if($request->id == 0){
            try {
                $banco= new Banco();
                $banco->Bancos = ucfirst($request['nombre']);
                $banco->Status_Id = $request['status'];
                $banco->Codigo_Bancario = $request['codigo'];
                $banco->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error('Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 Banco::where('id_Bancos_Bs', $id)->update([
                    'Bancos'=>ucfirst($request->nombre),
                    'Status_Id'=>$request->status,
                    'Codigo_Bancario'=>$request->codigo,
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('banco');
    }

  	public function edit(Request $request)
    {
        $id = (int)$request->input('id');

        $banks= Banco::where('id_Bancos_Bs','=', $id)->first();
        return response()->json([$banks]);
    }
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $banks= Banco::where('id_Bancos_Bs', $id)->delete();
        Flash::success('Registro eliminado correctamente');
         
      return redirect()->route('banco');
    }
}

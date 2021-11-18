<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Model\Ciudad;
use App\Model\Municipio;
use App\Model\Parroquia;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function ciudad(Request $request){
      $id = empty($request->input('estado')) ? 0 : $request->input('estado');
      $ciudades = [];

      if ($id > 0) {
        $ciudades = Ciudad::where('Estado_id', $id)
                        ->orderBy('Ciudad')->get(); 
      }
        return response()->json($ciudades);
    }

    public function municipio(Request $request){
      $id = empty($request->input('estado')) ? 0 : $request->input('estado');
      $municipios = [];

      if ($id > 0) {
        $municipios = Municipio::where('Estado_id', $id)
                        ->orderBy('Municipio')->get(); 
      }
        return response()->json($municipios);
    }

    public function parroquia(Request $request){
      $id = empty($request->input('municipio')) ? 0 : $request->input('municipio');
      $parroquias = [];

      if ($id > 0) {
        $parroquias = Parroquia::where('Municipio_id', $id)
                        ->orderBy('Parroquia')->get(); 
      }
        return response()->json($parroquias);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Model\Ciudad;
use App\Model\Municipio;
use App\Model\Especialidad;
use App\Model\Parroquia;
use App\Model\Horario;

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

     public function especialidad(Request $request){
      $id = empty($request->input('medico')) ? 0 : $request->input('medico');
      $especialidades = [];

      if ($id > 0) {
        $especialidades = Especialidad::
       select('especialidades_medicas.id_Especialidad_Medica AS id', 'especialidades_medicas.Espacialiadad_Medica AS name')
       ->join('control_especialidades', 'especialidades_medicas.id_Especialidad_Medica','control_especialidades.Especialidades_Medicas_id')
       ->where('control_especialidades.Medico_id',$id)
       ->get(); 
      }
        return response()->json($especialidades);
    }

    public function consultar_horario(Request $request){
      $id_Medico = empty($request->input('medico')) ? 0 : $request->input('medico');
      $id_espec = empty($request->input('espec')) ? 0 : $request->input('espec');

      $horarios = [];

      if ($id_espec > 0) {
        $horarios = Horario::where('Medico_id', $id_Medico)
                           ->where('Especialidad_id',$id_espec)
                           ->first(); 
      }
        return response()->json($horarios);
    }

}

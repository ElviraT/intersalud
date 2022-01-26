<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\Request;
use App\Model\Horario;
use App\Model\UsuarioM;
use App\Model\Especialidad;
use Flash;
use DB;

class HorariosController extends Controller
{
	 public function __construct()
    {
      $this->middleware('can:horario')->only('index');
      $this->middleware('can:horario.add')->only('add');
      $this->middleware('can:horario.edit')->only('edit');
      $this->middleware('can:horario.destroy')->only('destroy');
    }
    public function index(Horario $model)
    {
    	return view('admin.horarios.index', ['horarios' => $model->all()]);
    }

    public function create()
    {
      if(auth()->user()->name == 'Admin'){
         $medico=Collection::make(UsuarioM::select(['id_Medico',DB::raw('CONCAT(Nombres_Medico, " ", Apellidos_Medicos) AS Nombre')])->where('Status_Medico_id',1)->orderBy('Nombres_Medico')->pluck("Nombre", "id_Medico"));

          $especialidad = Collection::make(Especialidad::select(['id_Especialidad_Medica','Espacialiadad_Medica'])->orderBy('Espacialiadad_Medica')->pluck("Espacialiadad_Medica", "id_Especialidad_Medica")); 

      }else{
          $medico=Collection::make(UsuarioM::select(['id_Medico',DB::raw('CONCAT(Nombres_Medico, " ", Apellidos_Medicos) AS Nombre')])->where('Status_Medico_id',1)->where('id_Medico',auth()->user()->id_usuario)->orderBy('Nombres_Medico')->pluck("Nombre", "id_Medico"));

           $especialidad = Collection::make(Especialidad::
             select('especialidades_medicas.id_Especialidad_Medica AS id', 'especialidades_medicas.Espacialiadad_Medica AS name')
             ->join('control_especialidades', 'especialidades_medicas.id','control_especialidades.Especialidades_Medicas_id')
             ->where('control_especialidades.Medico_id',auth()->user()->id_usuario)
             ->get())->pluck('name','id'); 
      }

    	return view('admin.horarios.create')->with(compact('medico','especialidad'));
    }

    public function add(Request $request)
    {
      //dd($request);
      if($request->manana) {
        $manana = 1;
      }else{
        $manana = 0;
      }

      if($request->tarde) {
        $tarde = 1;
      }else{
        $tarde = 0;
      }

      if($request->domicilio) {
        $domicilio = 1;
      }else{
        $domicilio = 0;
      }

      if($request->lunes) {
        $lunes = 1;
      }else{
        $lunes = 0;
      }

      if($request->martes) {
        $martes = 1;
      }else{
        $martes = 0;
      }

      if($request->miercoles) {
        $miercoles = 1;
      }else{
        $miercoles = 0;
      }

      if($request->jueves) {
        $jueves = 1;
      }else{
        $jueves = 0;
      }

      if($request->viernes) {
        $viernes = 1;
      }else{
        $viernes = 0;
      }

      if($request->sabado) {
        $sabado = 1;
      }else{
        $sabado = 0;
      }

      if($request->domingo) {
        $domingo = 1;
      }else{
        $domingo = 0;
      }

      if($request->id == 0){
            try {
                $horario= new Horario();
                $horario->Medico_id = $request->medico;
                $horario->Especialidad_id = $request->especialidad;
                $horario->Manana = $manana;
                $horario->Tarde = $tarde;
                $horario->Domicilio = $domicilio;
                $horario->Hora_Inicio_Lunes = $request->hora_lunes1;
                $horario->Hora_Fin_Lunes = $request->hora_lunes2;
                $horario->Lunes = $lunes;
                $horario->Hora_Inicio_Martes = $request->hora_martes1;
                $horario->Hora_Fin_Martes = $request->hora_martes2;
                $horario->Martes = $martes;
                $horario->Horario_Inicio_Miercoles = $request->hora_miercoles1;
                $horario->Horario_Fin_Miercoles = $request->hora_miercoles2;
                $horario->Miercoles = $miercoles;
                $horario->Horario_Inicio_Jueves = $request->hora_jueves1;
                $horario->Horario_Fin_Jueves = $request->hora_jueves2;
                $horario->Jueves = $jueves;
                $horario->Horario_Inicio_Viernes = $request->hora_viernes1;
                $horario->Horario_Fin_Viernes = $request->hora_viernes2;
                $horario->Viernes = $viernes;
                $horario->Horario_Inicio_Sabado = $request->hora_sabado1;
                $horario->Horario_Fin_Sabado = $request->hora_sabado2;
                $horario->Sabado = $sabado;
                $horario->Horario_inicio_Domingo = $request->hora_domingo1;
                $horario->Horario_Fin_Domingo = $request->hora_domingo2;
                $horario->Domingo = $domingo;
                $horario->save();

                Flash::success("Registro Agregado Correctamente");            
            } catch (\Illuminate\Database\QueryException $e) {
                Flash::error($e.'Ocurrió un error, por favor intente de nuevo');    
            }
        }else{
            try{
                $id = (int)$request->id;
                 Horario::where('id_Horario_Cita', $id)->update([
                    'Medico_id' => $request->medico,
                    'Especialidad_id' => $request->especialidad,
                    'Manana'=>$manana,
                    'Tarde'=>$tarde,
                    'Domicilio'=>$domicilio,
                    'Hora_Inicio_Lunes'=>$request->hora_lunes1,
                    'Hora_Fin_Lunes'=>$request->hora_lunes2,
                    'Lunes'=>$lunes,
                    'Hora_Inicio_Martes'=>$request->hora_martes1,
                    'Hora_Fin_Martes'=>$request->hora_martes2,
                    'Martes'=>$martes,
                    'Horario_Inicio_Miercoles'=>$request->hora_miercoles1,
                    'Horario_Fin_Miercoles'=>$request->hora_miercoles2,
                    'Miercoles'=>$miercoles,
                    'Horario_Inicio_Jueves'=>$request->hora_jueves1,
                    'Horario_Fin_Jueves'=>$request->hora_jueves2,
                    'Jueves'=>$jueves,
                    'Horario_Inicio_Viernes'=>$request->hora_viernes1,
                    'Horario_Fin_Viernes'=>$request->hora_viernes2,
                    'Viernes'=>$viernes,
                    'Horario_Inicio_Sabado'=>$request->hora_sabado1,
                    'Horario_Fin_Sabado'=>$request->hora_sabado2,
                    'Sabado'=>$sabado,
                    'Horario_inicio_Domingo'=>$request->hora_domingo1,
                    'Horario_Fin_Domingo'=>$request->hora_domingo2,
                    'Domingo'=>$domingo,
                ]);

                Flash::success("Registro Modificado Correctamente");
             }catch(\Illuminate\Database\QueryException $e){                    
                Flash::error('Ocurrió un error, por favor intente de nuevo');
            }
        }
        return redirect()->route('horario');
    }

    public function edit($id)
    {
      $horarios = Horario::where('id_Horario_Cita', $id)->first();
      if(auth()->user()->name == 'Admin'){
         $medico=Collection::make(UsuarioM::select(['id_Medico',DB::raw('CONCAT(Nombres_Medico, " ", Apellidos_Medicos) AS Nombre')])->where('Status_Medico_id',1)->orderBy('Nombres_Medico')->pluck("Nombre", "id_Medico"));

          $especialidad = Collection::make(Especialidad::select(['id_Especialidad_Medica','Espacialiadad_Medica'])->orderBy('Espacialiadad_Medica')->pluck("Espacialiadad_Medica", "id_Especialidad_Medica")); 

      }else{
          $medico=Collection::make(UsuarioM::select(['id_Medico',DB::raw('CONCAT(Nombres_Medico, " ", Apellidos_Medicos) AS Nombre')])->where('Status_Medico_id',1)->where('id_Medico',auth()->user()->id_usuario)->orderBy('Nombres_Medico')->pluck("Nombre", "id_Medico"));

           $especialidad = Collection::make(Especialidad::
             select('especialidades_medicas.id_Especialidad_Medica AS id', 'especialidades_medicas.Espacialiadad_Medica AS name')
             ->join('control_especialidades', 'especialidades_medicas.id','control_especialidades.Especialidades_Medicas_id')
             ->where('control_especialidades.Medico_id',auth()->user()->id_usuario)
             ->get())->pluck('name','id'); 
      }
      return view('admin.horarios.edit')->with(compact('horarios','medico','especialidad'));
    }
    
    public function destroy(Request $request)
    {
       $id = (int)$request->input('id');
       $horario= Horario::where('id_Horario_Cita', $id)->delete();
        Flash::success('Registro eliminado correctamente');
         
       return redirect()->route('horario');
    }
}

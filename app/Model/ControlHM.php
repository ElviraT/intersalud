<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ControlHM extends Model
{
   protected $table = 'control_historia_medicas';
   protected $primary_key = 'id_Control_Historia_Medica';
   public $timestamps = false;

   protected $fillable = ['Especialidad_Medica_id','Control_Especialidad_id','Medico_id','Paciente_id','Paciente_Especial_id','Cita_Consulta_id','Fecha','id_servicio'];
}

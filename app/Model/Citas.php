<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Citas extends Model
{
   protected $table = 'citas_consultas';
   protected $primary_key = 'id_Cita_Consulta';
   public $timestamps = false;

   protected $fillable = ['Agenda_id','Paciente_id','Paciente_Especial_id','Medico_id','Asistente_id','Horario_Cita_Paciente','Max_paciente','Costo','Nota','Status_Consulta_id','title','start','end','color','confirmado','id_servicio','online'];

   public function ControlHM()
    {
        return $this->hasOne('App\Model\ControlHM', 'id_Control_Historia_Medica');
    }
}

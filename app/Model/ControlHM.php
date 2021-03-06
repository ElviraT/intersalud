<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ControlHM extends Model
{
   protected $table = 'control_historia_medicas';
   protected $primary_key = 'id_Control_Historia_Medica';
   public $timestamps = false;

   protected $fillable = ['Especialidad_Medica_id','Control_Especialidad_id','Medico_id','Paciente_id','Paciente_Especial_id','Cita_Consulta_id','Fecha','id_servicio'];
    
    public function Especialidad()
    {
        return $this->hasOne('App\Model\Especialidad', 'id_Especialidad_Medica','Especialidad_Medica_id');
    }

    public function Citas()
    {
        return $this->hasOne('App\Model\Citas', 'id_Cita_Consulta','Cita_Consulta_id');
    }
    
    public function UsuarioM()
    {
        return $this->hasOne('App\Model\UsuarioM', 'id_Medico', 'Medico_id');
    }

    public function UsuarioP()
    {
        return $this->hasOne('App\Model\UsuarioP', 'id_Paciente', 'Paciente_id');
    }

    public function Servicio()
    {
        return $this->hasOne('App\Model\Servicio', 'id_Servicio', 'id_servicio');
    }
}

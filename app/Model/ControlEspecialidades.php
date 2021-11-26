<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ControlEspecialidades extends Model
{
   protected $table = 'control_especialidades';
   protected $primary_key = 'id_Control_Especialidad';
   public $timestamps = false;

   public function StatusM()
    {
        return $this->hasOne('App\Model\StatusM', 'id_Status_Medico','Status_Medico_id');
    }

    public function Especialidad()
    {
        return $this->hasOne('App\Model\Especialidad', 'id_Especialidad_Medica','Especialidades_Medicas_id');
    }

     public function UsuarioM()
    {
        return $this->hasOne('App\Model\UsuarioM', 'id_Medico', 'Medico_id');
    }
}

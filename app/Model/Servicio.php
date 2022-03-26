<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
   protected $table = 'servicios';
   protected $primary_key = 'id_Servicio';
   public $timestamps = false;

   public function Status()
    {
        return $this->hasOne('App\Model\Status', 'id_Status','Status_id');
    }
    
    public function Especialidad()
    {
        return $this->hasOne('App\Model\Especialidad', 'id_Especialidad_Medica','Especialidad_Medica_id');
    }

    public function UsuarioM()
    {
        return $this->hasOne('App\Model\UsuarioM', 'id_Medico', 'Medico_id');
    }

    public function ControlHM()
    {
        return $this->hasOne('App\Model\ControlHM', 'id_Servicio', 'id_servicio');
    }
}

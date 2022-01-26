<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
   protected $table = 'agendas';
   protected $primary_key = 'id_Agenda';
   public $timestamps = false;

    public function Status()
    {
        return $this->hasOne('App\Model\Status', 'id_Status','Status_id');
    }
    public function Consultorio()
    {
        return $this->hasOne('App\Model\Consultorio', 'id_Consultorio','Consultorio_id');
    }
    public function Especialidad()
    {
        return $this->hasOne('App\Model\Especialidad', 'id_Especialidad_Medica','Especialidad_Medica');
    }
    public function UsuarioM()
    {
        return $this->hasOne('App\Model\UsuarioM', 'id_Medico', 'Medico_id');
    }
}

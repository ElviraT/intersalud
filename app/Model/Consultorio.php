<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Consultorio extends Model
{
   protected $table = 'consultorios';
   protected $primary_key = 'id_Consultorio';
   public $timestamps = false;

   public function Agenda()
    {
        return $this->hasOne('App\Model\Agenda', 'id_Agenda');
    }
    public function Status()
    {
        return $this->hasOne('App\Model\Status', 'id_Status','Status_id');
    }

    public function Especialidad()
    {
        return $this->hasOne('App\Model\Especialidad', 'id_Especialidad_Medica','Especialidad_Medica_id');
    }
}

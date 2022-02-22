<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
   protected $table = 'turnos';
   protected $primary_key = 'id_turno';
   public $timestamps = false;

    public function Horario()
    {
        return $this->hasOne('App\Model\Horario', 'id_Horario_Cita');
    }
}

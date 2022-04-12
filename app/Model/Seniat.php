<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Seniat extends Model
{
   protected $table = 'datos_seniat';
   protected $primary_key = 'id_Datos_SENIAT';
   public $timestamps = false;

   public function UsuarioM()
    {
        return $this->hasOne('App\Model\UsuarioM', 'id_Medico','Medico_id');
    }
}

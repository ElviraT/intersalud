<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UsuarioA extends Model
{
   protected $table = 'usuarios_asistentes';
   protected $primary_key = 'id_asistente';
   public $timestamps = false;

   public function Status()
    {
        return $this->hasOne('App\Model\Status', 'id_Status','Status_id');
    }

     public function UsuarioM()
    {
        return $this->hasOne('App\Model\UsuarioM', 'id_Medico', 'id_Medico');
    }
}

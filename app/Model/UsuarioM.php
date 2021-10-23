<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UsuarioM extends Model
{
   protected $table = 'usuarios_medicos';
   protected $primary_key = 'id_Medico';
   public $timestamps = false;

   public function StatusM()
    {
        return $this->hasOne('App\Model\StatusM', 'id_Status_Medico','Status_Medico_id',);
    }
}

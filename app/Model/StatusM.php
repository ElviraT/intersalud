<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StatusM extends Model
{
   protected $table = 'status_medicos';
   protected $primary_key = 'id_Status_Medico';
   public $timestamps = false;

    public function UsuarioM()
    {
        return $this->hasOne('App\Model\UsuarioM', 'id_Status_Medico');
    }

}

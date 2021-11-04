<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UsuarioP extends Model
{
   protected $table = 'usuarios_pacientes';
   protected $primary_key = 'id_Paciente';
   public $timestamps = false;

   public function Status()
    {
        return $this->hasOne('App\Model\Status', 'id_Status','Status_id',);
    }

    public function Sexo()
    {
        return $this->hasOne('App\Model\Sexo', 'id_Sexo','Sexo_id',);
    }

}

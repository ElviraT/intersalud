<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UsuarioPE extends Model
{
   protected $table = 'pacientes_especiales';
   protected $primary_key = 'id_Pacientes_Especiales';
   public $timestamps = false;

   public function Status()
    {
        return $this->hasOne('App\Model\Status', 'id_Status','Status_id');
    }

    public function Sexo()
    {
        return $this->hasOne('App\Model\Sexo', 'id_Sexo','Sexo_id');
    }
    public function PrefijoDNI()
    {
        return $this->hasOne('App\Model\PrefijoDNI', 'id_Prefijo_CIDNI','Prefijo_CIDNI_id');
    }
}

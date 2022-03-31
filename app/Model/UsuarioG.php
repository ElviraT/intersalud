<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UsuarioG extends Model
{
   protected $table = 'usuarios_general';
   protected $primary_key = 'id';
   public $timestamps = false;

   protected $fillable = ['id','nombre','id_prefijo_dni','cedula','id_sexo','fecha_nac','telefono','id_status','direccion'];

   public function Status()
    {
        return $this->hasOne('App\Model\Status', 'id_Status','id_status');
    }

    public function Sexo()
    {
        return $this->hasOne('App\Model\Sexo', 'id_Sexo', 'id_sexo');
    }

    public function PrefijoDNI()
    {
        return $this->hasOne('App\Model\PrefijoDNI', 'id_prefijo_dni','Prefijo_CIDNI_id');
    }
}

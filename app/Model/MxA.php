<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MxA extends Model
{
    protected $table = 'medicoxasistente';
    protected $primary_key = 'id';
    public $timestamps = false;

    public function UsuarioM()
    {
        return $this->hasOne('App\Model\UsuarioM', 'id_Medico','id_Medico');
    }

    public function UsuarioA()
    {
        return $this->hasOne('App\Model\UsuarioA', 'id_asistente','id_asistente');
    }
}

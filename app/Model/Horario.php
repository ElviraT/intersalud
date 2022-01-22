<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horarios_citas';
    protected $primary_key = 'id_Horario_Cita';
    public $timestamps = false;

    public function UsuarioM()
    {
        return $this->hasOne('App\Model\UsuarioM', 'id_Medico','Medico_id');
    }

    public function Especialidad()
    {
        return $this->hasOne('App\Model\Especialidad', 'id_Especialidad_Medica','Especialidad_id');
    }
}

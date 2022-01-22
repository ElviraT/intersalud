<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'especialidades_medicas';
    protected $primary_key = 'id_Especialidad_Medica';
    public $timestamps = false;

    public function Consultorio()
    {
        return $this->hasOne('App\Model\Consultorio', 'id_Especialidad_Medica');
    }

    public function ControlEspecialidades()
    {
        return $this->hasOne('App\Model\ControlEspecialidades', 'id_Especialidad_Medica');
    }

    public function Servicio()
    {
        return $this->hasOne('App\Model\Servicio', 'id_Especialidad_Medica');
    }

    public function Horario()
    {
        return $this->hasOne('App\Model\Horario', 'id_Horario_Cita', 'id_Especialidad_Medica');
    }
}

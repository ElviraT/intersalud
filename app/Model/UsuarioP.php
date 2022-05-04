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
        return $this->hasOne('App\Model\Status', 'id_Status','Status_id');
    }

    public function Sexo()
    {
        return $this->hasOne('App\Model\Sexo', 'id_Sexo','Sexo_id');
    }

    public function ControlHM()
    {
        return $this->hasOne('App\Model\ControlHM', 'id_Control_Historia_Medica');
    }
    public function PrefijoDNI()
    {
        return $this->hasOne('App\Model\PrefijoDNI', 'id_Prefijo_CIDNI','Prefijo_CIDNI_id');
    }
    public function DireccionPaciente()
    {
        return $this->hasOne('App\Model\DireccionPaciente', 'Paciente_id', 'id_Paciente');
    }
    public function Factura()
    {
        return $this->hasOne('App\Model\Factura', 'id_Paciente', 'Pacientes_id');
    }
}

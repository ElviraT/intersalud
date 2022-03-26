<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UsuarioM extends Model
{
   protected $table = 'usuarios_medicos';
   protected $primary_key = 'id_Medico';
   public $timestamps = false;

   public function Agenda()
    {
        return $this->hasOne('App\Model\Agenda', 'id_Agenda');
    }
    
   public function StatusM()
    {
        return $this->hasOne('App\Model\StatusM', 'id_Status_Medico','Status_Medico_id');
    }

    public function UsuarioA()
    {
        return $this->hasOne('App\Model\UsuarioA', 'id_asistente','id_Medico');
    }

    public function Billetera()
    {
        return $this->hasOne('App\Model\Billetera', 'id_Billetera_Cripto','id_Medico');
    }
    public function CuentaBanco()
    {
        return $this->hasOne('App\Model\CuentaBanco', 'id_Cuenta_Bancaria_BS','id_Medico');
    }

    public function ControlEspecialidades()
    {
        return $this->hasOne('App\Model\ControlEspecialidades', 'id_Control_Especialidad','id_Medico');
    }

    public function Servicio()
    {
        return $this->hasOne('App\Model\Servicio', 'id_Servicio','id_Medico');
    }

    public function User()
    {
        return $this->hasOne('App\User', 'id_usuario','id_Medico');
    }

    public function Horario()
    {
        return $this->hasOne('App\Model\Horario', 'id_Horario_Cita', 'id_Medico');
    }

    public function ControlHM()
    {
        return $this->hasOne('App\Model\ControlHM', 'id_Control_Historia_Medica');
    }
}

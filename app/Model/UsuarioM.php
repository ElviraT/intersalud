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

    public function UsuarioA()
    {
        return $this->hasOne('App\Model\UsuarioA', 'id_asistente','id_Medico',);
    }

    public function Billetera()
    {
        return $this->hasOne('App\Model\Billetera', 'id_Billetera_Cripto','id_Medico');
    }
    public function CuentaBanco()
    {
        return $this->hasOne('App\Model\CuentaBanco', 'id_Cuenta_Bancaria_BS','id_Medico');
    }
}

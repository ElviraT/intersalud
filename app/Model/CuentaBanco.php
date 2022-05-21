<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CuentaBanco extends Model
{
   protected $table = 'cuenta_bancaria_bs';
   protected $primary_key = 'id_Cuenta_Bancaria_BS';
   public $timestamps = false;

   public function Status()
    {
        return $this->hasOne('App\Model\Status', 'id_Status','Status_id');
    }
     public function UsuarioM()
    {
        return $this->hasOne('App\Model\UsuarioM', 'id_Medico', 'Medico_id');
    }
    public function Banco()
    {
        return $this->hasOne('App\Model\Banco', 'id_Bancos_Bs','Banco_id');
    }

    public function TipoCuenta()
    {
        return $this->hasOne('App\Model\TipoCuenta', 'id_Cuenta','Tipo');
    }

    public function PagoConfirmar()
    {
        return $this->hasOne('App\Model\PagoConfirmar', 'id_Cuenta_Bancaria_BS','cuenta_bs');
    }
}

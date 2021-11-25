<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TipoCuenta extends Model
{
   protected $table = 'tipos_cuentas';
   protected $primary_key = 'id_Cuenta';
   public $timestamps = false;

    public function CuentaBanco()
    {
        return $this->hasOne('App\Model\CuentaBanco', 'id_Cuenta_Bancaria_BS','Tipo');
    }
}

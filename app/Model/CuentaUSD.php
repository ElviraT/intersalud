<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CuentaUSD extends Model
{
   protected $table = 'cuenta_usd';
   protected $primary_key = 'id_Cuenta_USD';
   public $timestamps = false;

   public function Status()
    {
        return $this->hasOne('App\Model\Status', 'id_Status','Status_Pago');
    }
     public function UsuarioM()
    {
        return $this->hasOne('App\Model\UsuarioM', 'id_Medico', 'Medico_id');
    }
    public function EntidadesUSD()
    {
        return $this->hasOne('App\Model\EntidadesUSD', 'id_Entidad_USD','Entidad_USD_id');
    }

    public function TipoCuenta()
    {
        return $this->hasOne('App\Model\TipoCuenta', 'id_Cuenta','Tipo');
    }
}

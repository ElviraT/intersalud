<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PagoConfirmar extends Model
{
    protected $table = 'pagos_confirmar';
    public $timestamps = false;

    public function Banco()
    {
        return $this->hasOne('App\Model\Banco', 'id_Bancos_Bs','banco_emisor');
    }

    public function EntidadesUSD()
    {
        return $this->hasOne('App\Model\EntidadesUSD', 'id_Entidad_USD','entidad_emisora');
    }

    public function Billetera()
    {
        return $this->hasOne('App\Model\Billetera', 'billetera_emisora');
    }

    public function CuentaBanco()
    {
        return $this->hasOne('App\Model\CuentaBanco', 'id_Cuenta_Bancaria_BS','cuenta_bs');
    }

    public function CuentaUSD()
    {
        return $this->hasOne('App\Model\CuentaUSD', 'id_Cuenta_USD','cuenta_usd');
    }
}

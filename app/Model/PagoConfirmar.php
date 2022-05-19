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
}

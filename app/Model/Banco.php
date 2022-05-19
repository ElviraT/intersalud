<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
   protected $table = 'bancos_bs';
   protected $primary_key = 'id_Bancos_Bs';
   public $timestamps = false;

   public function Status()
    {
        return $this->hasOne('App\Model\Status', 'id_Status','Status_Id',);
    }
    public function CuentaBanco()
    {
        return $this->hasOne('App\Model\CuentaBanco', 'id_Cuenta_Bancaria_BS','Banco_id');
    }

    public function PagoConfirmar()
    {
        return $this->hasOne('App\Model\PagoConfirmar', 'id_Bancos_Bs','banco_emisor');
    }
}

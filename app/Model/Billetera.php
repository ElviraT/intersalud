<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Billetera extends Model
{
   protected $table = 'billeteras_cripto';
   protected $primary_key = 'id_Billetera_Cripto';
   public $timestamps = false;

   public function Status()
    {
        return $this->hasOne('App\Model\Status', 'id_Status','Status_id');
    }
     public function UsuarioM()
    {
        return $this->hasOne('App\Model\UsuarioM', 'id_Medico', 'Medicos_id');
    }
    public function Cripto()
    {
        return $this->hasOne('App\Model\Cripto', 'id_Cripto','Cripto_id');
    }

    public function PagoConfirmar()
    {
        return $this->hasOne('App\Model\PagoConfirmar', 'id_Billetera_Cripto','billetera_emisora');
    }
}

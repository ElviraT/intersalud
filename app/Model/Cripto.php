<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cripto extends Model
{
   protected $table = 'criptos';
   protected $primary_key = 'id_Cripto';
   public $timestamps = false;

   public function Status()
    {
        return $this->hasOne('App\Model\Status', 'id_Status','Status_id',);
    }

    public function Billetera()
    {
        return $this->hasOne('App\Model\Billetera', 'id_Cripto');
    }
}

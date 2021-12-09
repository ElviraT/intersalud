<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StatusT extends Model
{
   protected $table = 'status_tasas';
   protected $primary_key = 'id_Status_Tasa';
   public $timestamps = false;

    public function TipoCambio()
    {
        return $this->hasOne('App\Model\TipoCambio', 'id_Status_Tasa');
    }
}

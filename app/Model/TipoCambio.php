<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TipoCambio extends Model
{
   protected $table = 'tasa_cambio';
   protected $primary_key = 'id_Tasa_Cambio';
   public $timestamps = false;

   public function StatusT()
    {
        return $this->hasOne('App\Model\StatusT', 'id_Status_Tasa','Status_Tasa_id');
    }
}

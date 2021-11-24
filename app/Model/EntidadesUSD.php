<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EntidadesUSD extends Model
{
   protected $table = 'entidades_usd';
   protected $primary_key = 'id_Entidad_USD';
   public $timestamps = false;

   public function Status()
    {
        return $this->hasOne('App\Model\Status', 'id_Status','Status_id',);
    }
}

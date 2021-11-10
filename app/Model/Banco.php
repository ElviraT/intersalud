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
}

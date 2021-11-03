<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
   protected $table = 'status';
   protected $primary_key = 'id_Status';
   public $timestamps = false;

   public function UsuarioA()
    {
        return $this->hasOne('App\Model\UsuarioA', 'id_Status');
    }
}

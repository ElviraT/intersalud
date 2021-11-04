<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{
   protected $table = 'sexos';
   protected $primary_key = 'id_Sexo';
   public $timestamps = false;


    public function UsuarioP()
    {
        return $this->hasOne('App\Model\UsuarioP', 'Sexo_id');
    }
}

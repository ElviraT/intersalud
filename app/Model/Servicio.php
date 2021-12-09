<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
   protected $table = 'servicios';
   protected $primary_key = 'id_Servicio';
   public $timestamps = false;

}

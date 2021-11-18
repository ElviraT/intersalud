<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Consultorio extends Model
{
   protected $table = 'consultorios';
   protected $primary_key = 'id_Consultorio';
   public $timestamps = false;
}

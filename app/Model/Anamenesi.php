<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Anamenesi extends Model
{
   protected $table = 'anamnesis';
   protected $primary_key = 'id_anamnesis';
   public $timestamps = false;
}

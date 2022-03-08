<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Antecedente extends Model
{
   protected $table = 'antecedentes';
   protected $primary_key = 'id_antecedente';
   public $timestamps = false;
}

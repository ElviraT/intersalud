<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
   protected $table = 'agendas';
   protected $primary_key = 'id_Agenda';
   public $timestamps = false;
}

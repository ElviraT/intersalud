<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
   protected $table = 'tipo_pagos';
   protected $primary_key = 'id_Tipos_Pago';
   public $timestamps = false;
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'facturas';
    protected $primary_key = 'id_Factura';
    public $timestamps = false;
}

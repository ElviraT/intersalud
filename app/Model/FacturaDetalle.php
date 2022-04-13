<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FacturaDetalle extends Model
{
    protected $table = 'factura_detalle';
    protected $primary_key = 'id_Factura_Detalle';
    public $timestamps = false;
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FacturaUSD extends Model
{
    protected $table = 'factura_total_usd';
    protected $primary_key = 'id_Factura_USD';
    public $timestamps = false;
}

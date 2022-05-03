<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FacturaBs extends Model
{
    protected $table = 'factura_total_bs';
    protected $primary_key = 'id_Factura_BS';
    public $timestamps = false;
}

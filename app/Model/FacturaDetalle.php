<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FacturaDetalle extends Model
{
    protected $table = 'factura_detalle';
    protected $primary_key = 'id_Factura_Detalle';
    public $timestamps = false;

    public function Factura()
    { //belongsTo
    	return $this->belongsTo('App\Model\Factura', 'id_Factura', 'Factura_id');
    }

    public function Servicio()
    { //belongsTo
    	return $this->hasOne('App\Model\Servicio', 'id_Servicio', 'Servicio_id');
    }
}

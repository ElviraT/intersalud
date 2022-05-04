<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'facturas';
    protected $primary_key = 'id_Factura';
    public $timestamps = false;

    public function FacturaDetalle()
    { //belongsTo
    	return $this->hasMany('App\Model\FacturaDetalle', 'Factura_id', 'id_Factura');
    }
    
    public function UsuarioM()
    { //belongsTo
    	return $this->hasOne('App\Model\UsuarioM', 'id_Medico', 'Medico_id');
    }

    public function UsuarioP()
    { //belongsTo
    	return $this->hasOne('App\Model\UsuarioP', 'id_Paciente', 'Pacientes_id');
    }
}

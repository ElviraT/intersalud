<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ServicioA extends Model
{
    protected $table = 'servicios_adicionales';
    protected $primary_key = 'id';
    public $timestamps = false;

    protected $fillable = ['id','id_control','id_servicio','nota'];
}

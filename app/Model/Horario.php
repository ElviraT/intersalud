<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horarios_citas';
    protected $primary_key = 'id_Horario_Cita';
    public $timestamps = false;
}

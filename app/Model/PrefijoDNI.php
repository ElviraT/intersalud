<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PrefijoDNI extends Model
{
    protected $table = 'prefijos_cidni';
    public $timestamps = false;
    protected $primary_key = 'id_Prefijo_CIDNI';

    public function UsuarioPE()
    {
        return $this->hasOne('App\Model\UsuarioPE', 'Prefijo_CIDNI_id');
    }
}

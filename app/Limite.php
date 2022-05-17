<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Limite extends Model
{
   protected $table = 'limite_usuarios';
   protected $primary_key = 'id';

    protected $fillable =
     [
      'id',
      'administrativo',
      'medico',
      'asistente',
      'paciente',
      'status',
      'created_at',
      'updated_at',
  	 ];

  	 public function Status()
    {
        return $this->hasOne('App\Model\Status', 'id_Status','status');
    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
   protected $table = 'status';
   protected $primary_key = 'id_Status';
   public $timestamps = false;

   public function UsuarioA()
    {
        return $this->hasOne('App\Model\UsuarioA', 'id_Status');
    }

    public function UsuarioP()
    {
        return $this->hasOne('App\Model\UsuarioP', 'id_Status');
    }

    public function Banco()
    {
        return $this->hasOne('App\Model\Banco', 'id_Status');
    }

    public function EntidadesUSD()
    {
        return $this->hasOne('App\Model\EntidadesUSD', 'id_Status');
    }

    public function Cripto()
    {
        return $this->hasOne('App\Model\Cripto', 'id_Status');
    }
    public function Billetera()
    {
        return $this->hasOne('App\Model\Billetera', 'id_Status');
    }
    public function CuentaBanco()
    {
        return $this->hasOne('App\Model\CuentaBanco', 'id_Status');
    }
    public function Consultorio()
    {
        return $this->hasOne('App\Model\Consultorio', 'id_Status');
    }
}

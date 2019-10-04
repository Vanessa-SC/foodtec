<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'idUsuario';
    public $timestamps = false;
}

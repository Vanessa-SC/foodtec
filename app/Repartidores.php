<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repartidores extends Model
{
    protected $table = 'repartidor';
    protected $primaryKey = 'idRepartidor';
    public $timestamps = false;
}
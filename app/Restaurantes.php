<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurantes extends Model
{
    protected $table = 'restaurante';
    protected $primaryKey = 'idRestaurante';
    public $timestamps = false;
}


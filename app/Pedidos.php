<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Pedidos extends Model
{
    protected $table = 'pedido';
    protected $primaryKey = 'idPedido';
    public $timestamps = false;
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedidos;
use Carbon\Carbon;



class PedidosController extends Controller
{
    public function registrarPedido($idUsuario,$idRestaurante,$totalPedido){
        $fecha = Carbon::now()->toDateTimeString();
        try {
            $pedido = Pedidos::insert(['fecha'=>$fecha,'idUsuario'=>$idUsuario,
                    'idRestaurante'=>$idRestaurante,'totalPedido'=>$totalPedido,]);
            if($pedido == 1){
                $arr = array('resultado' => "insertado");
                echo json_encode($arr);
            } else {
                $arr = array('resultado' => "no insertado");
                echo json_encode($arr);
            }              
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->getMessage();
            $arr = array('estado' => $errorCode);

            echo json_encode($arr);
        }
    }

    public function consultarPedidoActual($idUsuario){
        $lastPedido = Pedidos::find($idUsuario)->last();
        echo $lastPedido;
    }
}

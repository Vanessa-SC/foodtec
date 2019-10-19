<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedidos;
use Carbon\Carbon;
use App\PedidoProducto;
use DB;

class PedidosController extends Controller
{
    
    public function insertarPedido($idUsuario,$idRest,$idProd,$precio,$idPago,$especs,$cantidad,$totalPedido,$ubicacion){
        $fecha = Carbon::now()->toDateTimeString();
        try {
                $idPedido = DB::table('pedido')
                ->insertGetId([
                    'idPago' => $idPago,
                    'idUsuario' => $idUsuario,
                    'idRestaurante' => $idRest,
                    'fecha' => $fecha,
                    'totalPedido' => $totalPedido,
                    'detalleUbicacion' => $ubicacion
                ]);

            $PedProd = PedidoProducto::insert(['idPedido'=>$idPedido,'idProducto'=>$idProd,'cantidad'=>$cantidad, 'totalProd'=>$totalPedido, 'especificaciones'=>$especs]);
                if($PedProd == 1){
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

    public function mostrarPedidos($idPedido){


        $ped = DB::table('pedido')
                    ->join('pedido_producto','producto.idProducto','=','pedido_producto.idProducto')
                     ->where( 'pedido_producto.idPedido','=',$idPedido)
                     ->get();
                     echo $ped;
    }
}

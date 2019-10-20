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

    public function mostrarPedidos($idUsuario){
        //consulta
        /*
        SELECT DISTINCT 
          pedido.idPedido, pedido.idUsuario, pedido.fecha, pedido.totalPedido
          producto.nombre as producto, 
          restaurante.ruta_imagen, 
          pedido_producto.cantidad 
        
        FROM 
            pedido, 
            producto, 
            pedido_producto, 
            restaurante
        WHERE 
            pedido.idRestaurante=restaurante.idRestaurante 
            AND pedido_producto.idProducto = producto.idProducto 
            AND pedido_producto.idPedido = pedido.idPedido
        ORDER BY pedido.idPedido
        
        */

        $pedidos = DB::table('pedido')->distinct()
                    ->join('restaurante','pedido.idRestaurante','=','restaurante.idRestaurante')
                    ->join('pedido_producto','pedido_producto.idPedido','=','pedido.idPedido')
                    ->join('producto','producto.idProducto','=','pedido_producto.idProducto')
                    ->where('pedido.idUsuario','=',$idUsuario)
                    ->select('pedido.idPedido', 'pedido.idUsuario', 'pedido.fecha', 'pedido.totalPedido',
                    'producto.nombre as producto', 
                    'restaurante.ruta_imagen', 
                    'pedido_producto.cantidad')
                    ->get();

                     echo $pedidos;
    }
}

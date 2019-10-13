<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedidos;
use Carbon\Carbon;
use App\PedidoProducto;
use DB;

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


    //http://127.0.0.1:8000/insertarPedido/idUsuario/idRest/idProd/precio/idPago(1)/Especs:ninguna/totalComp/ubicacion/cantidad
    public function insertarPedido2($idUsuario,$idRest,$idProd,$precio,$idPago,$especs,$totalPedido,$ubicacion,$cantidad){
        $fecha = Carbon::now()->toDateTimeString();
        try {
            $pedido = Pedidos::insert(['fecha'=>$fecha,'idUsuario'=>$idUsuario,
                    'idRestaurante'=>$idRest,'totalPedido'=>$totalPedido,]);
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

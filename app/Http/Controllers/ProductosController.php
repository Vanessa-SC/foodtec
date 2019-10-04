<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productos;
use App\RestauranteProducto;
use App\Restaurantes;
use DB;

class ProductosController extends Controller
{
    public function insertarProducto($nombre,$descripcion,$precio,$idRestaurante){
        $buscar = Productos::where('nombre', $nombre)
                          ->where('descripcion',$descripcion)
                          ->first();
            
        if($buscar == null){
            try {
                $idProducto = DB::table('producto')
                    ->insertGetId([
                    'descripcion' => $descripcion,
                    'nombre' => $nombre
                ]);
            $RestProd = RestauranteProducto::insert(['idRestaurante'=>$idRestaurante,'idProducto'=>$idProducto,'precio'=>$precio]);
                if($RestProd == 1){
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
        } else {
            $arr = array('estado' => 'Ya existe');
             echo json_encode($arr);
        }
    }

    public function updatePrecio($idProducto,$precio){
        try{
            $producto = productos::find($idProducto);

            $producto->precio = $precio;
            $producto->save();

            echo $producto;

        } catch(\Illuminate\Database\QueryException $e){
            $errorCore = $e->getMessage();
            $arr = array('estado' => $errorCore);

            echo json_encode($arr);
        }
    }
    //Producto -> idProducto
    //Restaurante_producto -> idProducto, idRestaurante
    //Restaurante -> idRestaurante, idUniversidad

    public function mostrarProductos($idRestaurante){


        $restau = DB::table('producto')
                    ->join('restaurante_producto','producto.idProducto','=','restaurante_producto.idProducto')
                     ->where( 'restaurante_producto.idRestaurante','=',$idRestaurante)
                     ->get();
                     echo $restau;

        // $producto = DB::table('producto')
        //             ->union($restUniv)
        //             ->union($restau)
        //             ->get();

   /* $productos = DB::table('producto')
                        ->join('restaurante_')*/

    }


 //   $tracks = track::with('Restaurante_Producto.idRestaurante')->where('idRestaurante',$idRestaurante)->get();
}

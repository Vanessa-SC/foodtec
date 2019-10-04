<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurantes;

class RestaurantesController extends Controller
{
    public function registrarRestaurante($nombre,$direccion,$telefono){
        try {
            $buscar = Restaurantes::where('nombre', $nombre)->first();
            
            if($buscar == null){
                $restaurante = Restaurantes::insert(['nombre'=>$nombre,'direccion'=>$direccion,'telefono'=>$telefono]);
                if($restaurante == 1){
                    $arr = array('resultado' => "insertado");
                    echo json_encode($arr);
                } else {
                    $arr = array('resultado' => "no insertado");
                    echo json_encode($arr);
                }
            } else {
                    $arr = array('estado' => 'Ya existe');
                    echo json_encode($arr);
                }
            
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->getMessage();
            $arr = array('estado' => $errorCode);

            echo json_encode($arr);
        }
    }

    public function mostrarNombres (){
        $restaurant = restaurante::get();
        echo $restaurant;
    }
    
    public function restaurantesUniv($univ){
        $restaurantes = restaurantes::where('universidad','=',$univ)->get();
        echo $restaurantes;
    }
}

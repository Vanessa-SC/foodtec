<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repartidores;
use DB;
use Session;
use Redirect;


class RepartidoresController extends Controller
{

    public function traer(){
        $usuario = Repartidores::get();
        echo $usuario;
    }

    public function loginR($contra, $usuario){
        
    try{
        $estatus = Repartidores::select('estatus')->where('email','=',$usuario)->where('password','=',$contra)->pluck('estatus')->first();
        $uc = new RepartidoresController;
        $correoExiste = $uc->comprobarCorreo($usuario);

            $usuario = Repartidores::where('password','=',$contra)->where('email','=',$usuario)->first();
            if(empty($usuario)){
                if($correoExiste){
                    $arr = array('idRepartidor'=> -2);
                    echo json_encode($arr);
                } else {
                    $arr = array('idRepartidor'=> 0);
                    echo json_encode($arr);
                }
                
            } else {
                if($estatus != -1){
                    echo $usuario;
                } else {
                    $arr = array('idRepartidor'=> -1);
                    echo json_encode($arr);
                }
            }
    } catch(\Illuminate\Database\QueryException $e){
        $errorCore = $e->getInfo[1];
        $arr = array('estado' => $errorCode);

        echo json_encode($arr);
    }


    }


}

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

    public function loginR($contra, $email){
        
        try{
         $estatus = Repartidores::select('estatus')->where('email','=',$email)->where('password','=',$contra)->pluck('estatus')->first();
            $rc = new RepartidoresController;
            $correoExiste = $rc->comprobarCorreo($email);

                $usuario = Repartidores::where('password','=',$contra)->where('email','=',$email)->first();
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
            $errorCode = $e->getMessage();
                $arr = array('estado' => $errorCode);
                echo json_encode($arr);
        }
    }

    public function correoExiste($correo){
        $email = Repartidores::select('email')->where('email','=',$correo)->first();

        if($email != null){
            return true;
        }
    }

    public function comprobarCorreo($correo){
        $ucont = new RepartidoresController;
        if( $ucont->correoExiste($correo)){
            return true;
        } 
    }


}

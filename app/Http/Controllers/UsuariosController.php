<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuarios;
use DB;
use Session;
use Redirect;


class UsuariosController extends Controller
{
    public function login2 ($contra, $usuario){
        //Obtener ID y volverlo global
        // $idUser = Usuarios::select('idUsuario')->where('email','=',$usuario)->where('password','=',$contra)->pluck('idUsuario')->first();
        // Session::put('idUser',$idUser);
        // echo ($IDusuario = Session::get('idUser'));

        try{
            $estatus = Usuarios::select('estatus')->where('email','=',$usuario)->first();
            echo json_encode($estatus);
            if($estatus == '{"estatus":-1}'){
                $arr = array('resultado' => "Cuenta desactivada");
                echo json_encode($arr);
            } else {
                $usuario = Usuarios::where('password','=',$contra)->where('email','=',$usuario)->first();

                if(empty($usuario)){
                    $arr = array('idUsuario'=> 0);
                    echo json_encode($arr);
                } else {
                    echo $usuario;
                }
            }
        } catch(\Illuminate\Database\QueryException $e){
            $errorCore = $e->getInfo[1];
            $arr = array('estado' => $errorCode);

            echo json_encode($arr);
        }
    }

    public function traer(){
        $usuario = Usuarios::get();
        echo $usuario;
    }

    public function insertar($nombre,$email,$contra,$telefono){
        try {
            $buscar = Usuarios::where('email', $email)->first();
            
            if($buscar == null){
                $usuario = Usuarios::insert(['nombre'=>$nombre,'email'=>$email,'password'=>$contra,'telefono'=>$telefono,'estatus'=>1]);
                if($usuario == 1){
                    $arr = array('resultado' => "insertado");
                    echo json_encode($arr);
                } else {
                    $arr = array('resultado' => "no insertado");
                    echo json_encode($arr);
                }
            } else {
                    $arr = array('estado' => 'Correo ya existe');
                    echo json_encode($arr);
                }
            
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->getMessage();
            $arr = array('estado' => $errorCode);

            echo json_encode($arr);
        }
    }

    public function updateContra($contra){
        try{
            $IDuser =  request()->session()->get('idUser');
            $usuario = Usuarios::find($IDuser);

            $usuario->password = $contra;
            $usuario->save();

            echo $usuario;

        } catch(\Illuminate\Database\QueryException $e){
            $errorCore = $e->getMessage();
            $arr = array('estado' => $errorCore);

            echo json_encode($arr);
        }
    }

    public function updateTel($telefono){
        try{
            $IDuser =  request()->session()->get('idUser');
            $usuario = Usuarios::find($IDuser);

            $usuario->telefono = $telefono;
            $usuario->save();

            echo $usuario;
        } catch(\Illuminate\Database\QueryException $e){
            $errorCore = $e->getMessage();
            $arr = array('estado' => $errorCore);

            echo json_encode($arr);
        }
    }


    public function mostrarDatos(){
        try{ 
            $IDuser =  request()->session()->get('idUser');
            $usuario = Usuarios::where('idUsuario',$IDuser)->first();

                echo $usuario;

        } catch(\Illuminate\Database\QueryException $e){
            $errorCore = $e->getMessage();
            $arr = array('estado' => $errorCore);

            echo json_encode($arr);
        }
    }
    
    public function desactivarCuentaxID(){
       echo $IDuser =  request()->session()->get('idUser');
        // Session::get('idUser')
        try {
            $update = DB::table('usuario')
                        ->where('idUsuario', $IDuser)
                        ->update(['estatus' => -1]);
           echo json_encode($update);
           return Redirect::to('http://192.168.1.70:8100/login');
         }catch(\Illuminate\Database\QueryException $e){
            $errorCore = $e->getMessage();
            $arr = array('estado' => $errorCore);
            echo json_encode($arr);
        }
    }


    public function desactivarCuenta($correo){
        try {
          
                $update = DB::table('usuario')
                ->where('email', $correo)
                ->update(['estatus' => -1]);

                if($update == 0){
                    $arr = array('email'=> 'no existe');
                    echo json_encode($arr);
                } else {
                    $arr = array('email'=> $correo);
                    echo json_encode($arr);
                }

        }catch(\Illuminate\Database\QueryException $e){
            $errorCore = $e->getMessage();
            $arr = array('estado' => $errorCore);
            echo json_encode($arr);
        }
    }



    public function login ($contra, $usuario){
        
        try{
            //Obtener ID y volverlo global
           $idUser = Usuarios::select('idUsuario')->where('email','=',$usuario)->where('password','=',$contra)->pluck('idUsuario')->first();
           Session::put('idUser',$idUser);
           $estatus = Usuarios::select('estatus')->where('email','=',$usuario)->where('password','=',$contra)->pluck('estatus')->first();

                $usuario = Usuarios::where('password','=',$contra)->where('email','=',$usuario)->first();
                if(empty($usuario)){
                    $arr = array('idUsuario'=> 0);
                    echo json_encode($arr);
                } else {
                    if($estatus != -1){
                        echo $usuario;
                    } else {
                        $arr = array('idUsuario'=> -1);
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

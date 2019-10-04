<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuarios;
use DB;

class UsuariosController extends Controller
{
    public function login ($contra, $usuario){
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

    public function updateContra($id,$contra){
        try{
            $usuario = Usuarios::find($id);

            $usuario->password = $contra;
            $usuario->save();

            echo $usuario;

        } catch(\Illuminate\Database\QueryException $e){
            $errorCore = $e->getMessage();
            $arr = array('estado' => $errorCore);

            echo json_encode($arr);
        }
    }

    public function updateTel($id,$telefono){
        try{
            $usuario = Usuarios::find($id);

            $usuario->telefono = $telefono;
            $usuario->save();

            echo $usuario;
        } catch(\Illuminate\Database\QueryException $e){
            $errorCore = $e->getMessage();
            $arr = array('estado' => $errorCore);

            echo json_encode($arr);
        }
    }


    public function mostrarDatos($id){
        try{
            $usuario = Usuarios::where('idUsuario',$id)->first();

                echo $usuario;

        } catch(\Illuminate\Database\QueryException $e){
            $errorCore = $e->getMessage();
            $arr = array('estado' => $errorCore);

            echo json_encode($arr);
        }
    }

    // public function desactivarCuenta($idUsuario){
    //     try {
    //         $usuario = Usuarios::find($idUsuario);

    //         $usuario->estatus = 0;
    //         $usuario->save();

    //         echo $usuario;
    //     }catch(\Illuminate\Database\QueryException $e){
    //         $errorCore = $e->getMessage();
    //         $arr = array('estado' => $errorCore);
    //         echo json_encode($arr);
    //     }
    // }


    public function desactivarCuenta($correo){
        try {
            $update = DB::table('usuario')
                        ->where('email', $correo)
                        ->update(['estatus' => -1]);

            echo $update;
        }catch(\Illuminate\Database\QueryException $e){
            $errorCore = $e->getMessage();
            $arr = array('estado' => $errorCore);
            echo json_encode($arr);
        }
    }

}

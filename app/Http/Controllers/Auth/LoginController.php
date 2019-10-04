<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest', ['only' => 'showLoginForm']);
    }

    public function showLoginForm(){
        return view('auth.login');
    }
    
    public function login() {
        $credenciales = $this->validate(request(), [
            'email' => 'email|required|string',
            'password' => 'required|string'
        ]);
    
    if (Auth::attempt($credenciales)) {
        //return $credenciales;
        return redirect()->route('dashboard');
    }

    return back()
                ->withErrors(['email'=>'Los datos no coinciden con nuestros registros.'])
                ->withInput(request(['email']));
    }
}

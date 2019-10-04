@extends('layouts.app')

@section('content')

    <form method="POST" action="{{ route('login') }}">
        {{ csrf_field()}}
        login
        <br>
        Email:
        <input type="email" name="email" placeholder="Ingresa tu email">
        Contraseña:
        <input type="password" name="password" placeholder="Ingresa tu contraseña">
        <button>Acceder</button>
    </form>
    




@endsection


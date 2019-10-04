@extends('layouts.app')


@section('content')

    <!-- $nombre = Auth::user()->nombre;
    $email = Auth::user()->email; -->
    <div class="card-body">

        <h4>Bienvenido {{ auth()->user()->nombre }} </h4>
        
    </div>

   <!--    <div class="panel-body">
    
      <strong>Email: </strong> auth()->user()->email 

    </div>

    <div class="panel-footer">
        <form method="POST" action="{{ route('logout') }}">
            {{ csrf_field() }}
            <button>Cerrar sesión</button>
        </form>
    </div> -->


@endsection

<!-- NOTA:
        Marca errores al tratar de obtener los datos del usuario que inició la sesión,
        el comando { { auth()  user()  valor } } - valor es nombre o usuario - nos marca el error
        Trying to get property 'valor' of non-object (View: D:\xampp\htdocs\FoodTec\foodtec\resources\views\dashboard.blade.php)


 -->
<?php



// Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('/', function(){
    return view('welcome');
});

    //USUARIOS

Route::get('login/{contra}/{usuario}', ['uses' => 'UsuariosController@login']);
Route::get('traer', ['uses' => 'UsuariosController@traer']);
Route::get('insertar/{nombre}/{email}/{contra}/{telefono}', ['uses' => 'UsuariosController@insertar']);
Route::get('update/{id}/{nombre}/{contra}/{telefono}', ['uses' => 'UsuariosController@actualizarDatos']);
Route::get('updateContra/{id}/{contra}', ['uses' => 'UsuariosController@updateContra']);
Route::get('updateTel/{id}/{telefono}', ['uses' => 'UsuariosController@updateTel']);
Route::get('perfil/{id}', ['uses' => 'UsuariosController@mostrarDatos']);
Route::get('desactivarCuenta/{idUsuario}', ['uses' => 'UsuariosController@desactivarCuenta']);

    //PRODUCTOS

Route::get('insertarProducto/{nombre}/{descripcion}/{precio}/{idRestaurante}', ['uses' => 'ProductosController@insertarProducto']);
Route::get('updateProd/{id}/{precio}', ['uses' => 'ProductosController@updatePrecio']);
Route::get('productos/{Universidad}', ['uses' => 'ProductosController@mostrarProductos']);

    //RESTAURANTES

Route::get('restaurant', ['uses' => 'RestauranteController@mostrarNombres']);
Route::get('registrarRestaurante/{nombre}/{direccion}/{telefono}', ['uses' => 'RestaurantesController@registrarRestaurante']);
Route::get('restaurante/{universidad}', ['uses' => 'RestaurantesController@restaurantesUniv']);

    //PEDIDOS

Route::get('registrarPedido/{idPago}/{idUsuario}/{idRestaurante}/{totalPedido})',['uses' => 'PedidosController@registrarPedido']);
Route::get('consultarPedidoActual/{idUsuario}',['uses' => 'PedidosController@consultarPedidoActual']);
Route::get('registrarPedido/{idUsuario}/{idRestaurante}/{totalPedido}',['uses' => 'PedidosController@registrarPedido']);






?>
<?php



// Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('/', function(){
    return view('welcome');
});


    //USUARIOS

Route::get('login/{contra}/{usuario}', ['uses' => 'UsuariosController@login']);
Route::get('traer', ['uses' => 'UsuariosController@traer']);
Route::get('insertar/{nombre}/{email}/{contra}/{telefono}', ['uses' => 'UsuariosController@insertar']);
Route::get('update/{nombre}/{contra}/{telefono}', ['uses' => 'UsuariosController@actualizarDatos']);
Route::get('updateContra/{id}/{contraAct}/{contraNew}', ['uses' => 'UsuariosController@updateContra']);
Route::get('updateTel/{id}/{telefono}', ['uses' => 'UsuariosController@updateTel']);
Route::get('perfil/{idUsuario}', ['uses' => 'UsuariosController@mostrarDatos']);
Route::get('desactivarCuenta/{correo}', ['uses' => 'UsuariosController@desactivarCuenta']);
Route::get('desactivarCuentaxID', ['uses' => 'UsuariosController@desactivarCuentaxID']);

    //PRODUCTOS

Route::get('insertarProducto/{nombre}/{descripcion}/{precio}/{idRestaurante}', ['uses' => 'ProductosController@insertarProducto']);
Route::get('updateProd/{id}/{precio}', ['uses' => 'ProductosController@updatePrecio']);
Route::get('productos/{Universidad}', ['uses' => 'ProductosController@mostrarProductos']);

    //RESTAURANTES

Route::get('restaurant', ['uses' => 'RestauranteController@mostrarNombres']);
Route::get('registrarRestaurante/{nombre}/{direccion}/{telefono}', ['uses' => 'RestaurantesController@registrarRestaurante']);
Route::get('restaurante/{universidad}', ['uses' => 'RestaurantesController@restaurantesUniv']);

    //PEDIDOS
Route::get('insertarPedido/{idUsuario}/{idRest}/{idProd}/{precio}/{idPago}/{especs}/{totalPedido}/{ubicacion}/{cantidad}',['uses' => 'PedidosController@insertarPedido']);
Route::get('insertarPedido/{idPago}/{idUsuario}/{idRestaurante}/{totalPedido}',['uses' => 'PedidosController@insertarPedido']);
Route::get('consultarPedidoActual/{idUsuario}',['uses' => 'PedidosController@consultarPedidoActual']);
Route::get('registrarPedido/{idUsuario}/{idRestaurante}/{totalPedido}',['uses' => 'PedidosController@registrarPedido']);


    //RUTAS DE PRUEBA
Route::get('comprobarCorreo/{correo}', ['uses' => 'UsuariosController@comprobarCorreo']);




?>
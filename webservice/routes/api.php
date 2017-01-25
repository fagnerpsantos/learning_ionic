<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/entrar', 'LoginController@login');

Route::get('/usuarios', function () {
    return response()->json(App\User::all());
});

Route::post('/cadastro','CadastroController@registrar');

Route::put('/cadastro','CadastroController@atualizar')->middleware('auth:api');

Route::group(['middleware'=>['auth:api']], function(){
	Route::resource('listas', 'ListaController');
	Route::resource('compras', 'CompraController');
});




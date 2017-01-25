<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function __construct(){
		header('Access-Control-Allow-Origin: *');
	}

	public function login(Request $request){
		$dados = $request->all();
		if(Auth::attempt(['email'=>$dados['email'], 'password'=>$dados['password']])){
			return response()->json(['data'=>Auth::user(), 'status'=>true]);

		}else{
			return response()->json(['data'=>'Erro no login!', 'status'=>false]);
		}
	}
}

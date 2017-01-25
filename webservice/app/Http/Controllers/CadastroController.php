<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class CadastroController extends Controller
{
	public function __construct(){
		header('Access-Control-Allow-Origin: *');
	}
    public function registrar(Request $request){
    	$dados = $request->all();
    	$dados['api_token'] = str_random(60);
    	if(!User::where('email', $dados['email'])->count()){
    		$dados['password'] = bcrypt($dados['password']);
    		$user = User::create($dados);
    		return response()->json(['data'=>$user, 'status'=>true]);
    	}else{
    		return response()->json(['data'=>'Usuário cadastrado!', 'status'=>false]);
    	}

    }

    public function atualizar(Request $request){
            $user = $request->user();
            $dados = $request->all();
            if($user->email != $dados['email'] && User::where('email', $dados['email'])->count()){
                return response()->json(['data'=>'Usuário já cadastrado!', 'status'=>false]);
            }
            
            if(isset($dados['password'])){
                $dados['password'] = bcrypt($dados['password']);
            }

            $ret = $user->update($dados);

            if($ret){
                return response()->json(['data'=>$user, 'status'=>true]);
            } else {
                return response()->json(['data'=>'Erro ao atualizar!', 'status'=>false]);

            }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lista;

class ListaController extends Controller
{

    public function __construct(){
        header('Access-Control-Allow-Origin: *');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        return response()->json(['data'=>$user->listas, 'status'=>true]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $dados = $request->all();
        $ret = $user->listas()->create($dados);
        if($ret){
            return response()->json(['data'=>$user->listas, 'status'=>true]);

        }else{
            return response()->json(['data'=>'Erro ao criar registro', 'status'=>false]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth()->user();
        $lista = $user->listas()->find($id);
        if($lista){
            return response()->json(['data'=>$lista, 'status'=>true]);

        }
        return response()->json(['data'=>'Essa lista não existe', 'status'=>false]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $dados = $request->all();
        $lista = $user->listas()->find($id);
        $ret = $lista->update($dados);

        if($ret){
            return response()->json(['data'=>$user->listas, 'status'=>true]);

        }else{
            return response()->json(['data'=>'Erro ao atualizar registro', 'status'=>false]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $lista = $user->listas()->find($id);
        if($lista->compras()->count()){
            foreach ($lista->compras as $key => $value) {
                $value->delete();
            }
        }
        $lista->delete();
        return response()->json(['data'=>$user->listas, 'status'=>true]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Compra;

class CompraController extends Controller
{
    public function __construct()
    {
      header('Access-Control-Allow-Origin: *');
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
        $data = $request->all();
        $lista = $user->listas()->find($data['lista_id']);
        if(!$lista){
          return response()->json(['data'=>'Essa lista não existe', 'status'=>false]);
        }
        $data['valor_format'] = number_format($data['valor'],2,',','.');
        $res = $lista->compras()->create($data);
        if($res){
          return response()->json(['data'=>$lista->compras, 'status'=>true]);
        }else{
          return response()->json(['data'=>'Erro ao criar o registro', 'status'=>false]);
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
        $compras = $user->listas()->find($id)->compras;
        return response()->json(['data'=>$compras, 'status'=>true]);
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
        $data = $request->all();
        $lista = $user->listas()->find($data['lista_id']);
        if(!$lista){
          return response()->json(['data'=>'Essa lista não existe', 'status'=>false]);
        }
        $compra = $lista->compras()->find($id);
        if(!$compra){
          return response()->json(['data'=>'Essa compra não existe', 'status'=>false]);
        }
        $data['valor_format'] = number_format($data['valor'],2,',','.');
        $res = $compra->update($data);
        if($res){
          return response()->json(['data'=>$lista->compras, 'status'=>true]);
        }else{
          return response()->json(['data'=>'Erro ao atualizar o registro', 'status'=>false]);
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
        if(!Compra::find($id)){
          return response()->json(['data'=>'Essa compra não existe', 'status'=>false]);
        }
        $lista = Compra::find($id)->lista;
        if(!$user->listas()->find($lista->id)){
          return response()->json(['data'=>'Essa compra não pertence a esse usuário', 'status'=>false]);
        }
        $compra = $user->listas()->find($lista->id)->compras()->find($id);
        if(!$compra){
          return response()->json(['data'=>'Essa compra não pertence a esse usuário', 'status'=>false]);
        }
        $res = $compra->delete();
        if($res){
          return response()->json(['data'=>$lista->compras, 'status'=>true]);
        }else{
          return response()->json(['data'=>'Erro ao deletar o registro', 'status'=>false]);
        }

    }
}

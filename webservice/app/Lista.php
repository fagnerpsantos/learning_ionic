<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    protected $fillable = [
        'user_id', 'titulo', 'descricao'
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function compras(){
        return $this->hasMany('App\Compra');
    }
}

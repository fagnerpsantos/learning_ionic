<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
  protected $fillable = [
      'lista_id', 'titulo', 'descricao', 'valor', 'valor_format'
  ];

  public function lista()
  {
    return $this->belongsTo('App\Lista');
  }
}

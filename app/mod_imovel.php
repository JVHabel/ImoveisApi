<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mod_imovel extends Model
{
    protected $table = 'imoveis';

    protected $fillable = [
        'codigo',
        'tipo',
        'pretensao',
        'titulo',
        'detalhes',
        'quartos',
        'valor'
    ];

    public function immobile(){
        return $this->belongsToMany('app\mod_interesse', 'interesses');
    }


}

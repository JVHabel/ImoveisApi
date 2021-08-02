<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mod_interesse extends Model
{
    protected $table = 'interessados';

    protected $fillable = [
        'nome',
        'email'
    ];

    public function interest(){
        return $this->belongsToMany('app\mod_imovel', 'interesses', 'interessado_id', 'imovel_id');
    }
}

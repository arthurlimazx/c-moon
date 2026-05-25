<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Missao extends Model


{

    protected $table = 'missoes';
    
    protected $fillable = [
        'nome',
        'data_lancamento',
        'data_retorno',
        'status',
        'descricao',
        'corpo_celeste_id'

    ];

    

    public function astronautas() {
            return $this->belongsToMany(Astronauta::class, 'astronauta_missao');
            }
    public function corpo() {
    return $this->belongsTo(Corpo::class, 'corpo_celeste_id');
}
}



<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Corpo extends Model
{
    protected $table = 'corpos';
    protected $fillable = [
        'nome',
        'tipo',
        'distancia_terra',
        'descricao',
        'diametro_km'
        

    ];

    public function missoes() {
    return $this->hasMany(Missao::class, 'corpo_celeste_id');
}
}

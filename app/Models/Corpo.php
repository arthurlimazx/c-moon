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
        'descricao'
        

    ];

    public function corpo()
    {
        return $this->belongsTo(Corpo::class, 'corpo_celeste_id');
    }
}

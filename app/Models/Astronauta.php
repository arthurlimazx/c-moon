<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Astronauta extends Model
{
    //
    protected $table = 'astronautas';
    protected $fillable= [
        'nome',
        'nacionalidade',
        'especialidade',
        'num_missoes',
        'status'
    ];

    public function missoes() {
            return $this->belongsToMany(Missao::class, 'astronauta_missao');
            }
}

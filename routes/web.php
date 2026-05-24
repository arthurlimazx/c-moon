<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AstronautaController;
use App\Http\Controllers\CorpoController;
use App\Http\Controllers\MissaoController;

Route::get('/', function () {
    return view('welcome');
});

route::resource('astronautas', AstronautaController::class);
route::resource('corpos', CorpoController::class);
route::resource('missoes', MissaoController::class);
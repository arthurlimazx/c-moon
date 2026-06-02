<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AstronautaController;
use App\Http\Controllers\CorpoController;
use App\Http\Controllers\MissaoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    })->name('logout');

    // ── Todos autenticados: só leitura ──
    Route::resource('astronautas', AstronautaController::class)->only(['index', 'show']);
    Route::resource('corpos', CorpoController::class)->only(['index', 'show']);
    Route::resource('missoes', MissaoController::class)->only(['index', 'show'])->parameters(['missoes' => 'missao']);
});

// ── Só admin: criar, editar, deletar ──
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('astronautas', AstronautaController::class)->except(['index', 'show']);
    Route::resource('corpos', CorpoController::class)->except(['index', 'show']);
    Route::resource('missoes', MissaoController::class)->except(['index', 'show'])->parameters(['missoes' => 'missao']);
});

require __DIR__.'/auth.php';
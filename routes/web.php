<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
Route::get('/', function () {
    return view('dashboard'); 
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
    // ───────────────────────────────────────────────────────────────────
});

Route::middleware('auth')->group(function () {
    Route::resource('astronautas', \App\Http\Controllers\AstronautaController::class);
    Route::resource('corpos', \App\Http\Controllers\CorpoController::class);
    Route::resource('missoes', \App\Http\Controllers\MissaoController::class)->parameters(['missoes' => 'missao']);
});

require __DIR__.'/auth.php';
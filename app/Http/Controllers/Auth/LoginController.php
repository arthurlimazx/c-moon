<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Mostra a linda tela de login que você enviou
    public function showLoginForm()
    {
        return view('auth.login'); // Abre o seu login.blade.php
    }

    // Processa o envio dos dados do formulário
    public function login(Request $request)
    {
        // 1. Valida os dados de entrada
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Tenta autenticar usando o Model User automático do Laravel
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();

            // Login funcionou! Vai para a home
            return redirect()->intended(route('home'))->with('success', 'Bem-vindo ao C-Moon!');
        }

        // 3. Se falhar, volta com a mensagem de erro que sua view já espera
        return back()->withErrors([
            'email' => 'As credenciais fornecidas não coincidem com nossos registros.',
        ])->onlyInput('email');
    }

    // Desloga o usuário
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Sessão encerrada.');
    }
}
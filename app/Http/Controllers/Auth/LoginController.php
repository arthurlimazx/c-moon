<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    
    public function showLoginForm()
    {
        return view('auth.login'); 
    }

   
    public function login(Request $request)
    {
       
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

       
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();

            
            return redirect()->intended(route('home'))->with('success', 'Bem-vindo ao C-Moon!');
        }

       
        return back()->withErrors([
            'email' => 'As credenciais fornecidas não coincidem com nossos registros.',
        ])->onlyInput('email');
    }

  
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Sessão encerrada.');
    }
}
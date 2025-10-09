<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{


    public function index()
    {
        return inertia('Auth/Login');
    }

    public function login(Request $request)
    {

        $credencias = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            
        ],[
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um e-mail válido.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
        ]);

        if (Auth::attempt($credencias, $request->remember)) {
            $request->session()->regenerate();

             Auth::user()->update([
                'last_login_at' => now(),
            ]);
            
            return redirect()->intended('livraria');
            
        } else {

            return back()->withErrors([
                'mensagem' => 'Email ou senha inválidos',
            ]);
        }
    }


    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::route('laravue');
    }

    
}

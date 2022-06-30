<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function login()
    {


        // $usuario = new User;
        // $usuario->name = "Jean Carlos";
        // $usuario->email = "jeancarloscharao@gmail.com";
        // $usuario->password = Hash::make("12345678");
        // $usuario->save();


        return view('usuarios.login');
    }

    public function logar(Request $request)
    {




        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('usuarios/dashboard');
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('email');
    }


    public function dashboard()
    {

        return view('usuarios.dashboard');
    }


    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/usuarios/login');
    }
}

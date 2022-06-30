<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    public function login(){


        // $cliente = new Cliente;
        // $cliente->name = "Jean Carlos";
        // $cliente->email = "jeancarloscharao@gmail.com";
        // $cliente->password = Hash::make("12345678");
        // $cliente->save();


        return view('clientes.login');



    }

    public function logar(Request $request){




        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('cliente')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('clientes/dashboard');
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('email');

    }


    public function dashboard(){

        return view('clientes.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('cliente')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/clientes/login');
    }
}

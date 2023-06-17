<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $auth = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];

        $remember = isset($data['remember']) ? true : false;

        if (Auth::attempt($auth, $remember)) {

            $request->session()->regenerate();
 
            return redirect()->intended();
        }
 
        return back()->withErrors([
            'email' => 'Los datos ingresados no coinciden con los registros',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('login');
    }
}

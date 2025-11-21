<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credenciales = $request->only('user_name','user_pass');

        $user =\App\Models\crud\productos::where('user_name', $credenciales['user_name'])->first();
        
        if($user && Hash::check($credenciales['user_name'], $user->user_pass))
        {
            Auth::guard('usuarios')->login($user);
            return redirect()->intended('/productos/inicio');
        }

        return back()->whithErrors([
            'user_name' => 'Las credenciales no se encuentran en nuestros registros.'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('usuarios')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthManager extends Controller
{
    public function login()
    {
        return view('login');
    }


public function loginPost(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('dashboard.admin');
        } elseif ($user->role === 'commercial') {
            return redirect()->route('dashboard.commercial');
        } elseif ($user->role === 'owner') {
            return redirect()->route('dashboard.owner');
        } else {
            return redirect()->route('login')->withErrors([
                'email' => 'Rôle non reconnu.'
            ]);
        }
    }

    return redirect()->route('login')->withErrors([
        'email' => 'Invalid email or password.'
    ]);
}

   
   
 
    public function logout(Request $request) 
    { 
        Auth::logout();  // Déconnecter l'utilisateur 
        $request->session()->invalidate();  // Invalider la session 
        $request->session()->regenerateToken();  // Régénérer le token CSRF pour la sécurité 
        return redirect(route('login'))->with('success', 'Logged out successfully.');  // Rediriger vers la page d'accueil ou autre 
    }
}

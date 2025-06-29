<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


        public function edit()
{
    $user = Auth::user();
    return view('mon-compte.edit', compact('user'));
}

public function update(Request $request)
{
    $request->validate([
        'prenom' => 'required|string|max:100',
        'nom' => 'required|string|max:100',
        'email' => 'required|email|unique:users,email,' . Auth::id(),
    ]);

    $user = Auth::user();
    $user->update($request->only('prenom', 'nom', 'email'));

    return back()->with('success', 'Informations mises à jour.');
}

public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'password' => 'required|confirmed|min:8',
    ]);

    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->mot_de_passe_hash)) {
        return back()->withErrors(['current_password' => 'Mot de passe actuel incorrect.']);
    }

    $user->update([
        'mot_de_passe_hash' => bcrypt($request->password),
    ]);

    return back()->with('success', 'Mot de passe mis à jour.');
}




/**** ADMIN FONCTIONS */

}

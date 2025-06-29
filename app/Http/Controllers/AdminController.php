<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth'); // Assure que l'utilisateur est connecté
    
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }






   

    


    /*** ADMIN FONCTIONS */
     public function index()
    {
        $users = User::all();
        return view('admin.utilisateurs.index', compact('users'));
    }

    public function create()
    {
        return view('admin.utilisateurs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'prenom' => 'required|string|max:100',
            'nom' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'mot_de_passe' => 'required|string|min:6',
            'role' => 'required|in:commercial,admin,owner',
        ]);

        User::create([
            'prenom' => $validated['prenom'],
            'nom' => $validated['nom'],
            'email' => $validated['email'],
            'mot_de_passe_hash' => Hash::make($validated['mot_de_passe']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.utilisateurs.index')->with('success', 'Utilisateur créé avec succès.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'Utilisateur supprimé.');
    }

 
public function edit(User $user)
{
    return view('admin.utilisateurs.edit', compact('user'));
}

public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'prenom' => 'required|string|max:100',
        'nom' => 'required|string|max:100',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required|in:commercial,admin,owner',
    ]);

    $user->update($validated);

    return redirect()->route('admin.utilisateurs.index')->with('success', 'Utilisateur mis à jour.');
}
}

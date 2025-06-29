<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PharmacieControllerAdmin extends Controller
{
    /**
     * Affiche la liste des pharmacies
     */
    public function index(Request $request)
    {
        $query = Pharmacy::with('user')->latest();

        // Filtres
        if ($request->has('search')) {
            $query->where('nom', 'like', '%'.$request->search.'%')
                  ->orWhere('adresse', 'like', '%'.$request->search.'%');
        }

        if ($request->has('statut')) {
            $query->where('statut', $request->statut);
        }

        $pharmacies = $query->paginate(20);

        return view('admin.pharmacies.index', compact('pharmacies'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        $commerciaux = User::where('role', 'commercial')->get();
        return view('admin.pharmacies.create', compact('commerciaux'));
    }

    /**
     * Enregistre une nouvelle pharmacie
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'email' => 'nullable|email|unique:pharmacies,email',
            'telephone' => 'nullable|string|max:20',
            'statut' => ['required', Rule::in(['prospect', 'client_actif', 'client_inactif'])],
            'region' => 'nullable|string|max:255',
            'departement' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'user_id' => 'required|exists:users,id',
            
        ]);

        Pharmacy::create($validated);

        return redirect()->route('admin.pharmacies.index')
                         ->with('success', 'Pharmacie créée avec succès');
    }

    /**
     * Affiche les détails d'une pharmacie
     */
    public function show(Pharmacy $pharmacy)
    {
        return view('admin.pharmacies.show', compact('pharmacy'));
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Pharmacy $pharmacy)
    {
        $commerciaux = User::where('role', 'commercial')->get();
        return view('admin.pharmacies.edit', compact('pharmacy', 'commerciaux'));
    }

    /**
     * Met à jour une pharmacie
     */
    public function update(Request $request, Pharmacy $pharmacy)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'email' => ['nullable', 'email', Rule::unique('pharmacies')->ignore($pharmacy->id)],
            'telephone' => 'nullable|string|max:20',
            'statut' => ['required', Rule::in(['prospect', 'client_actif', 'client_inactif'])],
            'region' => 'nullable|string|max:255',
            'departement' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'user_id' => 'required|exists:users,id',
        ]);

        $pharmacy->update($validated);

        return redirect()->route('admin.pharmacies.index')
                         ->with('success', 'Pharmacie mise à jour avec succès');
    }

    /**
     * Supprime une pharmacie
     */
    public function destroy(Pharmacy $pharmacy)
    {
        $pharmacy->delete();

        return redirect()->route('admin.pharmacies.index')
                         ->with('success', 'Pharmacie supprimée avec succès');
    }
}
<?php
// CONTROLLER : app/Http/Controllers/CommandeController.php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;


class CommandeController extends Controller
{
    public function index(Request $request)
{
    $query = Commande::with('pharmacy')
        ->where('user_id', Auth::id());

    if ($request->filled('statut')) {
        $query->where('statut', $request->statut);
    }

    if ($request->filled('zone')) {
        $query->where('zone_geographique', 'like', "%{$request->zone}%");
    }

    if ($request->filled('numero_facture')) {
        $query->where('numero_facture', 'like', "%{$request->numero_facture}%");
    }

    $commandes = $query->orderBy('date', 'desc')->get();

    return view('commandes.index', compact('commandes'));
}


    public function create() {
        $pharmacies = Pharmacy::all();
        return view('commandes.form', compact('pharmacies'));
    }

    public function store(Request $request) {
    $validated = $request->validate([
        'pharmacy_id' => 'required|exists:pharmacies,id',
        'quantite' => 'required|integer|min:1',
        'statut' => 'required|in:en_cours,envoye,annule',
        'date' => 'required|date',
        'zone_geographique' => 'nullable|string',
        'notes' => 'nullable|string',
    ]);

    $validated['user_id'] = Auth::id();

    // Génération d'un numéro de facture unique
    $validated['numero_facture'] = $this->generateUniqueInvoiceNumber();

    // Création de la commande
    $commande = Commande::create($validated);

    // 🔄 Mise à jour du statut de la pharmacie si elle est en "prospect"
    $pharmacy = $commande->pharmacy; // Assure-toi que la relation existe
    if ($pharmacy && $pharmacy->statut === 'prospect') {
        $pharmacy->statut = 'client_actif';
        $pharmacy->save();
    }

    return redirect()->route('mes-commandes.index')->with('success', 'Commande ajoutée.');
}

    public function edit(Commande $mes_commande) {
     
        $pharmacies = Pharmacy::all();
        return view('commandes.form', ['commande' => $mes_commande, 'pharmacies' => $pharmacies]);
    }

    public function update(Request $request, Commande $mes_commande) {
       

        $validated = $request->validate([
            'pharmacy_id' => 'required|exists:pharmacies,id',
            'quantite' => 'required|integer|min:1',
            'statut' => 'required|in:en_cours,envoye,annule',
            'date' => 'required|date',
            'zone_geographique' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $mes_commande->update($validated);

        return redirect()->route('mes-commandes.index')->with('success', 'Commande mise à jour.');
    }

    public function destroy(Commande $mes_commande) {
     
        $mes_commande->delete();
        return back()->with('success', 'Commande supprimée.');
    }

    public function facture(Commande $mes_commande)
{
   

    $pdf = Pdf::loadView('commandes.facture', compact('mes_commande'));

    return $pdf->download('facture-commande-' . $mes_commande->id . '.pdf');
}

// Fonction pour générer un numéro unique (exemple simple)
private function generateUniqueInvoiceNumber()
{
    do {
        $number = 'FAC-' . strtoupper(Str::random(8)); // FAC- + 8 caractères alphanumériques
    } while (\App\Models\Commande::where('numero_facture', $number)->exists());

    return $number;
}
}

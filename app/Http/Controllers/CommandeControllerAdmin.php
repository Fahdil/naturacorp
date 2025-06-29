<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CommandeControllerAdmin extends Controller
{
    /**
     * Affiche la liste des commandes
     */
    public function index(Request $request)
    {
        $query = Commande::with(['user', 'pharmacy'])
            ->orderBy('date', 'desc');

        // Filtres
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('pharmacy_id')) {
            $query->where('pharmacy_id', $request->pharmacy_id);
        }

        if ($request->filled('date_debut')) {
            $query->where('date', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->where('date', '<=', $request->date_fin);
        }

        $commandes = $query->paginate(20);
        $pharmacies = Pharmacy::orderBy('nom')->get();

        return view('admin.commandes.index', compact('commandes', 'pharmacies'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        $pharmacies = Pharmacy::orderBy('nom')->get();
        $commerciaux = User::where('role', 'commercial')->orderBy('nom')->get();
        
        return view('admin.commandes.create', compact('pharmacies', 'commerciaux'));
    }

    /**
     * Enregistre une nouvelle commande
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pharmacy_id' => 'required|exists:pharmacies,id',
            'user_id' => 'required|exists:users,id',
            'quantite' => 'required|integer|min:1',
            'date' => 'required|date',
            'zone_geographique' => 'nullable|string|max:191',
            'notes' => 'nullable|string',
            'statut' => ['required', Rule::in(['en_cours', 'envoye', 'annule'])]
        ]);

        // Générer un numéro de facture unique
        $validated['numero_facture'] = 'CMD-' . date('Ymd') . '-' . strtoupper(uniqid());

        Commande::create($validated);

        return redirect()->route('admin.commandes.index')
            ->with('success', 'Commande créée avec succès');
    }

    /**
     * Affiche les détails d'une commande
     */
    public function show(Commande $commande)
    {
        return view('admin.commandes.show', compact('commande'));
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Commande $commande)
    {
        $pharmacies = Pharmacy::orderBy('nom')->get();
        $commerciaux = User::where('role', 'commercial')->orderBy('nom')->get();
        
        return view('admin.commandes.edit', compact('commande', 'pharmacies', 'commerciaux'));
    }

    /**
     * Met à jour une commande
     */
    public function update(Request $request, Commande $commande)
    {
        $validated = $request->validate([
            'pharmacy_id' => 'required|exists:pharmacies,id',
            'user_id' => 'required|exists:users,id',
            'quantite' => 'required|integer|min:1',
            'date' => 'required|date',
            'zone_geographique' => 'nullable|string|max:191',
            'notes' => 'nullable|string',
            'statut' => ['required', Rule::in(['en_cours', 'envoye', 'annule'])]
        ]);

        $commande->update($validated);

        return redirect()->route('admin.commandes.index')
            ->with('success', 'Commande mise à jour avec succès');
    }

    /**
     * Supprime une commande
     */
    public function destroy(Commande $commande)
    {
        $commande->delete();

        return redirect()->route('admin.commandes.index')
            ->with('success', 'Commande supprimée avec succès');
    }

    /**
     * Export des commandes au format CSV
     */
    public function export(Request $request)
    {
        $fileName = 'commandes_' . date('Y-m-d') . '.csv';
        $commandes = Commande::with(['user', 'pharmacy'])
            ->orderBy('date', 'desc')
            ->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"             => "no-cache",
            "Cache-Control"      => "must-revalidate, post-check=0, pre-check=0",
            "Expires"            => "0"
        );

        $columns = [
            'ID', 
            'Numéro Facture', 
            'Date', 
            'Pharmacie', 
            'Commercial', 
            'Quantité', 
            'Statut', 
            'Zone', 
            'Notes'
        ];

        $callback = function() use($commandes, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($commandes as $commande) {
                $row = [
                    $commande->id,
                    $commande->numero_facture,
                    $commande->date,
                    $commande->pharmacy->nom,
                    $commande->user->nom . ' ' . $commande->user->prenom,
                    $commande->quantite,
                    $commande->statut,
                    $commande->zone_geographique,
                    $commande->notes
                ];

                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pharmacy; // On suppose que le modèle existe
use Illuminate\Support\Facades\Auth;
use App\Models\Commande;

class PharmacyController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

       $query = Pharmacy::withSum('commandes', 'quantite')
    ->where('user_id', $user->id); // On suppose que les pharmacies sont liées à un commercial

        // Filtres
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('region')) {
            $query->where('region', $request->region);
        }

        if ($request->filled('departement')) {
            $query->where('departement', $request->departement);
        }

        // Tri volume_commande
        if ($request->filled('sort')) {
            if ($request->sort === 'volume') {
                $query->orderBy('commandes_sum_quantite', 'desc');
            } elseif ($request->sort === 'alpha') {
                $query->orderBy('nom');
            }
        }

        $pharmacies = $query->paginate(20);

        return view('commercial.pharmacies', compact('pharmacies'));
    }

    public function create()
{
    $departements = config('departements');

        return view('commercial.form', [
            'pharmacy' => null,
            'departements' => $departements
        ]);

    
}

public function store(Request $request)
{
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'adresse' => 'required|string',
        'email' => 'nullable|email',
        'telephone' => 'nullable|string|max:20',
        'statut' => 'required|in:prospect,client_actif,client_inactif',
        'region' => 'nullable|string',
        'departement' => 'nullable|string',
        'latitude'  => 'nullable|string',
        'longitude'  => 'nullable|string',
    ]);

    // Vérification de doublon (par exemple via nom+adresse)
    $exists = \App\Models\Pharmacy::where('nom', $validated['nom'])
                ->where('adresse', $validated['adresse'])
                ->exists();

    if ($exists) {
        return back()->withErrors(['nom' => 'Une pharmacie avec ce nom et cette adresse existe déjà.'])->withInput();
    }

    $validated['user_id'] = auth()->id();

    \App\Models\Pharmacy::create($validated);

    return redirect()->route('pharmacies.index')->with('success', 'Pharmacie ajoutée avec succès.');
}


public function edit($id)
{
    $pharmacy = \App\Models\Pharmacy::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
   
    $departements = config('departements');

    return view('commercial.form', compact('pharmacy', 'departements'));

}

public function update(Request $request, $id)
{
    $pharmacy = \App\Models\Pharmacy::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'adresse' => 'required|string',
        'email' => 'nullable|email',
        'telephone' => 'nullable|string|max:20',
        'statut' => 'required|in:prospect,client_actif,client_inactif',
        'region' => 'nullable|string',
        'departement' => 'nullable|string',
        'latitude'  => 'nullable|string',
        'longitude'  => 'nullable|string',
    ]);

    $pharmacy->update($validated);

    return redirect()->route('pharmacies.index')->with('success', 'Pharmacie mise à jour.');
}

public function show($id)
{
    $pharmacy = \App\Models\Pharmacy::where('id', $id)
                ->where('user_id', auth()->id())
                ->firstOrFail();

    return view('commercial.show', compact('pharmacy'));
}

public function destroy($id)
{
    $pharmacy = Pharmacy::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
    $pharmacy->delete();

    return redirect()->route('pharmacies.index')->with('success', 'Pharmacie supprimée avec succès.');
}


private function geocodeAdresse($adresse)
{
    $url = 'https://nominatim.openstreetmap.org/search';
    $response = Http::get($url, [
        'q' => $adresse,
        'format' => 'json',
        'limit' => 1,
    ]);

    if ($response->successful() && !empty($response[0])) {
        return [
            'latitude' => $response[0]['lat'],
            'longitude' => $response[0]['lon'],
        ];
    }

    return null;
}


public function commandesJson(Pharmacy $pharmacy)
{
    $commandes = Commande::where('pharmacy_id', $pharmacy->id)
        ->orderBy('date', 'desc')
        ->get(['id', 'quantite', 'statut', 'date']);

    return response()->json(['commandes' => $commandes]);
}

public function geojson()
{
    $pharmacies = Pharmacy::whereNotNull('latitude')->whereNotNull('longitude')->get();

    $features = $pharmacies->map(function ($pharmacy) {
        return [
            'type' => 'Feature',
            'geometry' => [
                'type' => 'Point',
                'coordinates' => [(float)$pharmacy->longitude, (float)$pharmacy->latitude],
            ],
            'properties' => [
                'nom' => $pharmacy->nom,
                'statut' => $pharmacy->statut,
                'adresse' => $pharmacy->adresse,
            ],
        ];
    });

    return response()->json([
        'type' => 'FeatureCollection',
        'features' => $features,
    ]);
}

public function map()
{
    return view('commercial.carte');
}


}

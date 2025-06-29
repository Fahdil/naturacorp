// MIGRATION : database/migrations/2024_01_01_000000_create_commandes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('pharmacy_id')->constrained()->onDelete('cascade');
            $table->integer('quantite');
            $table->enum('statut', ['en_cours', 'envoye', 'annule'])->default('en_cours');
            $table->date('date');
            $table->string('zone_geographique')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('commandes');
    }
};


// MODEL : app/Models/Commande.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'pharmacy_id', 'quantite', 'statut', 'date', 'zone_geographique', 'notes'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function pharmacy() {
        return $this->belongsTo(Pharmacy::class);
    }
}


// CONTROLLER : app/Http/Controllers/CommandeController.php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

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
        Commande::create($validated);

        return redirect()->route('mes-commandes.index')->with('success', 'Commande ajoutée.');
    }

    public function edit(Commande $mes_commande) {
        $this->authorize('update', $mes_commande);
        $pharmacies = Pharmacy::all();
        return view('commandes.form', ['commande' => $mes_commande, 'pharmacies' => $pharmacies]);
    }

    public function update(Request $request, Commande $mes_commande) {
        $this->authorize('update', $mes_commande);

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
        $this->authorize('delete', $mes_commande);
        $mes_commande->delete();
        return back()->with('success', 'Commande supprimée.');
    }

    public function facture(Commande $mes_commande) {
        $this->authorize('view', $mes_commande);
        $pdf = PDF::loadView('commandes.facture', compact('mes_commande'));
        return $pdf->download('facture-commande-' . $mes_commande->id . '.pdf');
    }
}


// RESSOURCES VUES :
// resources/views/commandes/index.blade.php, form.blade.php, facture.blade.php
// À générer ensuite si tu veux, avec un design similaire à celui de pharmacie (table, filtres, boutons, formulaire).

// N'oublie pas d'ajouter les autorisations (Policy) si besoin
// php artisan make:policy CommandePolicy --model=Commande

// et déclarer les routes dans web.php :
// Route::resource('mes-commandes', CommandeController::class);

<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    public function index(Request $request)
    {
        // 1. Déterminer la période
        $period = $request->query('period', 'month');
        [$startDate, $endDate, $label] = $this->getDateRange($period, $request);
        
        // 2. Calculer la période précédente pour les comparaisons
        $daysDiff = $startDate->diffInDays($endDate) + 1;
        $prevStartDate = $startDate->copy()->subDays($daysDiff);
        $prevEndDate = $startDate->copy()->subDay();

        // 3. Récupérer les filtres
        $zoneId = $request->query('zone');
        $statut = $request->query('statut');

        // 4. Requêtes principales
        // Commandes actuelles - utilisant uniquement le champ 'date'
        $currentQuery = Commande::with(['pharmacy', 'user'])
            ->whereDate('date', '>=', $startDate)
            ->whereDate('date', '<=', $endDate);

        // Commandes période précédente
        $previousQuery = Commande::query()
            ->whereDate('date', '>=', $prevStartDate)
            ->whereDate('date', '<=', $prevEndDate);

        // Appliquer les filtres
        if ($zoneId) {
            $currentQuery->whereHas('pharmacy', fn($q) => $q->where('zone_id', $zoneId));
            $previousQuery->whereHas('pharmacy', fn($q) => $q->where('zone_id', $zoneId));
        }

        if ($statut) {
            $currentQuery->where('statut', $statut);
            $previousQuery->where('statut', $statut);
        }

        $currentCommandes = $currentQuery->get();
        $previousCommandes = $previousQuery->get();

        // 5. Calcul des indicateurs
        // Totaux
        $total = $currentCommandes->count();
        $previousTotal = $previousCommandes->count();
        $evolutionTotal = $this->calculateEvolution($previousTotal, $total);

        // Commandes envoyées
        $envoyees = $currentCommandes->where('statut', 'envoye')->count();
        $previousEnvoyees = $previousCommandes->where('statut', 'envoye')->count();
        $evolutionEnvoyees = $this->calculateEvolution($previousEnvoyees, $envoyees);

        // Commandes annulées
        $annulees = $currentCommandes->where('statut', 'annule')->count();
        $previousAnnulees = $previousCommandes->where('statut', 'annule')->count();
        
        // Taux d'annulation
        $tauxAnnulation = $total > 0 ? round(($annulees / $total) * 100) : 0;
        $previousTauxAnnulation = $previousTotal > 0 ? round(($previousAnnulees / $previousTotal) * 100) : 0;
        $evolutionAnnulation = $this->calculateEvolution($previousTauxAnnulation, $tauxAnnulation);

        // Commandes en cours
        $enCours = $currentCommandes->where('statut', 'en_cours')->count();

        // Volume total
        $volume = $currentCommandes->sum('quantite');
        $previousVolume = $previousCommandes->sum('quantite');
        $evolutionVolume = $this->calculateEvolution($previousVolume, $volume);

        // 6. Statistiques par zone
        $commandesParZone = Commande::query()
            ->select('zone_geographique', DB::raw('COUNT(*) as count'))
            ->whereDate('date', '>=', $startDate)
            ->whereDate('date', '<=', $endDate)
            ->when($zoneId, fn($q) => $q->whereHas('pharmacy', fn($q) => $q->where('zone_id', $zoneId)))
            ->when($statut, fn($q) => $q->where('statut', $statut))
            ->groupBy('zone_geographique')
            ->orderByDesc('count')
            ->get();

        // 7. Tendance mensuelle
        $tendanceMensuelle = Commande::query()
            ->select(
                DB::raw("DATE_FORMAT(date, '%Y-%m') as month"),
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(quantite) as volume')
            )
            ->whereDate('date', '>=', $startDate->copy()->subMonths(11))
            ->whereDate('date', '<=', $endDate)
            ->when($zoneId, fn($q) => $q->whereHas('pharmacy', fn($q) => $q->where('zone_id', $zoneId)))
            ->when($statut, fn($q) => $q->where('statut', $statut))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // 8. Dernières commandes (toutes, sans filtre utilisateur)
        $dernieresCommandes = Commande::with(['pharmacy', 'user'])
            ->orderByDesc('date')
            ->limit(10)
            ->get();

        // 9. Zones pour le filtre
        $zones = Zone::orderBy('ville')->get();

        return view('admin.statistiques', compact(
            'total',
            'envoyees',
            'annulees',
            'enCours',
            'volume',
            'evolutionTotal',
            'evolutionEnvoyees',
            'evolutionVolume',
            'evolutionAnnulation',
            'tauxAnnulation',
            'commandesParZone',
            'tendanceMensuelle',
            'dernieresCommandes',
            'zones',
            'label',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Détermine la période en fonction des paramètres
     */
    private function getDateRange(string $period, Request $request): array
    {
        switch ($period) {
            case 'today':
                return [Carbon::today(), Carbon::today(), "Aujourd'hui"];
            case 'week':
                return [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek(), "Cette semaine"];
            case 'quarter':
                return [Carbon::now()->startOfQuarter(), Carbon::now()->endOfQuarter(), "Ce trimestre"];
            case 'year':
                return [Carbon::now()->startOfYear(), Carbon::now()->endOfYear(), "Cette année"];
            case 'custom':
                $start = $request->query('dateDebut') 
                    ? Carbon::parse($request->query('dateDebut')) 
                    : Carbon::now()->subMonth();
                $end = $request->query('dateFin') 
                    ? Carbon::parse($request->query('dateFin')) 
                    : Carbon::now();
                return [$start, $end, "Période personnalisée"];
            case 'month':
            default:
                return [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth(), "Ce mois"];
        }
    }

    /**
     * Calcule l'évolution en pourcentage entre deux valeurs
     */
    private function calculateEvolution($previous, $current): int
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        return (int) round((($current - $previous) / $previous) * 100);
    }

    public function exportExcel(Request $request)
    {
        // À implémenter selon vos besoins
    }

    public function exportPdf(Request $request)
    {
        // À implémenter selon vos besoins
    }

    
 

}
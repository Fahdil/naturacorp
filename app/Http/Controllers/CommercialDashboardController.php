<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommercialDashboardController extends Controller
{
    /**
     * Display the commercial dashboard with statistics
     */
    public function index()
    {
        $user = Auth::user();
        
        // Verify the user is a commercial
        if ($user->role !== 'commercial') {
            abort(403, 'Unauthorized access');
        }

        $stats = $this->getDashboardStatistics($user);
        
        return view('commercial.dashboard', compact('stats'));
    }

    /**
     * Calculate dashboard statistics for the commercial
     */
    protected function getDashboardStatistics($user)
    {
        $now = now();
        $lastMonth = now()->subMonth();
        
        // Pharmacy statistics
        $totalPharmacies = Pharmacy::where('user_id', $user->id)->count();
        $lastMonthPharmacies = Pharmacy::where('user_id', $user->id)
            ->where('created_at', '<=', $lastMonth)
            ->count();
        
        $pharmacyGrowth = $lastMonthPharmacies > 0 
            ? round(($totalPharmacies - $lastMonthPharmacies) / $lastMonthPharmacies * 100, 1)
            : 0;

        // Order statistics (last 30 days)
        $totalOrders = Commande::where('user_id', $user->id)
            ->where('date', '>=', $now->subDays(30))
            ->count();
        
        $lastMonthOrders = Commande::where('user_id', $user->id)
            ->whereBetween('date', [$lastMonth->subDays(30), $lastMonth])
            ->count();
        
        $orderGrowth = $lastMonthOrders > 0 
            ? round(($totalOrders - $lastMonthOrders) / $lastMonthOrders * 100, 1)
            : 0;

        // Order status summary
        $ordersEnCours = Commande::where('user_id', $user->id)
            ->where('statut', 'en_cours')
            ->count();
        
        $ordersEnvoye = Commande::where('user_id', $user->id)
            ->where('statut', 'envoye')
            ->count();
        
        $ordersAnnule = Commande::where('user_id', $user->id)
            ->where('statut', 'annule')
            ->count();

        return [
            'total_pharmacies' => $totalPharmacies,
            'pharmacy_growth' => $pharmacyGrowth,
            'total_orders' => $totalOrders,
            'order_growth' => $orderGrowth,
            'orders_en_cours' => $ordersEnCours,
            'orders_envoye' => $ordersEnvoye,
            'orders_annule' => $ordersAnnule,
        ];
    }
}
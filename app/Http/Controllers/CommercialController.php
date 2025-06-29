<?php

namespace App\Http\Controllers;


use App\Models\Pharmacy;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommercialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
         $this->middleware('auth'); // Assure que l'utilisateur est connecté
     
    }

   /* public function dashboard()
    {
        return view('commercial.dashboard');
    }*/
    
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

            public function dashboard()
        {
            $user = auth()->user();
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
            
            $stats = [
                'total_pharmacies' => $totalPharmacies,
                'pharmacy_growth' => $pharmacyGrowth,
                'total_orders' => $totalOrders,
                'order_growth' => $orderGrowth,
                'orders_en_cours' => $ordersEnCours,
                'orders_envoye' => $ordersEnvoye,
                'orders_annule' => $ordersAnnule,
            ];
            
            return view('commercial.dashboard', compact('stats'));
        }
}

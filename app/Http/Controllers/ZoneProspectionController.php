<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;



use App\Notifications\ZoneAssignedNotification;







class ZoneProspectionController extends Controller
{
    public function index()
    {
        $zones = Zone::all();
        $commerciaux = User::where('role', 'commercial')->with('zones')->get();

        return view('admin.zones.index', compact('zones', 'commerciaux'));
    }

public function assignZone(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'zone_id' => 'required|exists:zones,id',
    ]);

    $user = User::findOrFail($request->user_id);
    $zone = Zone::findOrFail($request->zone_id);

    if (!$user->zones()->where('zone_id', $zone->id)->exists()) {
        $user->zones()->attach($zone->id, ['assigned_by' => auth()->id()]);

        // 🔔 Envoi de la notification
        $user->notify(new ZoneAssignedNotification($zone));

        return back()->with('success', 'Zone attribuée au commercial.');
    }

    return back()->with('error', 'Cette zone est déjà attribuée à ce commercial.');
}

   public function detachZone($userId, $zoneId)
    {
        $user = User::findOrFail($userId);
        $user->zones()->detach($zoneId);

        return back()->with('success', 'Zone retirée du commercial.');
    }

        public function import(Request $request)
{
    $request->validate([
        'zones_csv' => 'required|file|mimes:csv,txt',
    ]);

    $path = $request->file('zones_csv')->getRealPath();
    $rows = array_map('str_getcsv', file($path));
    $header = array_map('trim', $rows[0]);

    unset($rows[0]); // enleve l'en-tête

    foreach ($rows as $row) {
        $data = array_combine($header, $row);

        Zone::updateOrCreate(
            ['code_postal' => $data['code_postal']],
            ['ville' => $data['ville']]
        );
    }

    return redirect()->route('admin.zones.index')->with('success', 'Importation terminée.');
}




        
}

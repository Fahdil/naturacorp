<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;

        protected $fillable = [
        'nom',
        'adresse',
        'email',
        'telephone',
        'statut',
        'region',
        'departement',
        'latitude',
        'longitude',
        'user_id',
        'zone_id',
    ];

    public function commandes()
{
    return $this->hasMany(Commande::class);
}

public function zone() {
    return $this->belongsTo(Zone::class);
}


public function user()
{
    return $this->belongsTo(User::class);
}

}

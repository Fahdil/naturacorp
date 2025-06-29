<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'pharmacy_id', 'quantite', 'statut',  'date' , 'zone_geographique', 'notes','numero_facture'
    ];
    protected $casts = [
    'date' => 'datetime',
];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function pharmacy() {
        return $this->belongsTo(Pharmacy::class);
    }



}

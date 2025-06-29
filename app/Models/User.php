<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    protected $table = 'users'; // OK, ta table s'appelle users

    protected $fillable = [
        'prenom',
        'nom',
        'email',
        'mot_de_passe_hash',
        'role',
    ];

    // Ce que Laravel utilisera comme mot de passe
    public function getAuthPassword()
    {
        return $this->mot_de_passe_hash;
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isCommercial()
    {
        return $this->role === 'commercial';
    }

    public function isOwner()
    {
        return $this->role === 'owner';
    }

    public function zones()
    {
        return $this->belongsToMany(Zone::class)->withPivot('assigned_by')->withTimestamps();
    }

}

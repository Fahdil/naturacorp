<?php

namespace Database\Factories;

use App\Models\Commande;
use App\Models\User;
use App\Models\Pharmacy;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommandeFactory extends Factory
{
    protected $model = Commande::class;

    public function definition(): array
    {
        return [
            'numero_facture' => $this->faker->unique()->numerify('FAC-#####'),
            'user_id' => User::factory(),
            'pharmacy_id' => Pharmacy::factory(),
            'quantite' => $this->faker->numberBetween(1, 100),
            'statut' => $this->faker->randomElement(['en_cours', 'annule', 'envoye']),
            'date' => $this->faker->date(),
            'zone_geographique' => $this->faker->city(),
            'notes' => $this->faker->sentence(),
        ];
    }
}


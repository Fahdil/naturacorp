<?php

namespace Database\Factories;

use App\Models\Pharmacy;
use Illuminate\Database\Eloquent\Factories\Factory;

class PharmacyFactory extends Factory
{
    protected $model = Pharmacy::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->company(),
            'adresse' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'telephone' => $this->faker->phoneNumber(),
            'statut' => $this->faker->randomElement(['client_inactif', 'client_actif', 'prospect']), // adapte selon tes statuts
            'region' => $this->faker->state(),
            'departement' => $this->faker->citySuffix(), // adapte si tu as des valeurs spécifiques
            'zone_id' => $this->faker->numberBetween(1, 10), // adapte si tu as une table zone
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'user_id' => \App\Models\User::factory(),
            'volume_commande' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}

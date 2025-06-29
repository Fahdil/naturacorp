<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Pharmacy;

class CommandeTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_utilisateur_peut_creer_une_commande()
    {
        $user = User::factory()->create();
        $pharmacy = Pharmacy::factory()->create();

        $response = $this->actingAs($user)->post('/mes-commandes', [
            'pharmacy_id' => $pharmacy->id,
            'quantite' => 10,
            'statut' => 'en_cours',
            'date' => now()->toDateString(),
            'zone_geographique' => 'Lyon',
            'notes' => 'Test automatique',
            'user_id' => 2
        ]);

        $response->assertRedirect(route('mes-commandes.index'));
        $this->assertDatabaseHas('commandes', [
            'quantite' => 10,
            'zone_geographique' => 'Lyon'
        ]);
    }
}

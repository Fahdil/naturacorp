<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Commande;
use App\Models\Pharmacy;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommandeFunctionalityTest extends TestCase
{
    use RefreshDatabase;

public function test_commercial_can_create_commande()
{
    $user = User::factory()->create(['role' => 'commercial']);
    $pharmacy = Pharmacy::factory()->create();

    $this->actingAs($user);

    $commandeData = [
        'pharmacy_id' => $pharmacy->id,
        'quantite' => 10,
        'statut' => 'en_cours',
        'date' => now(),
        'zone_geographique' => 'Zone Nord',
        'notes' => 'Commande test',
    ];

    $response = $this->post('/mes-commandes', $commandeData);

    $response->assertRedirect();
    
    // Check that a commande was created with the expected data
    $this->assertDatabaseHas('commandes', [
        'user_id' => $user->id,
        'pharmacy_id' => $pharmacy->id,
        'quantite' => 10,
        'statut' => 'en_cours',
        'zone_geographique' => 'Zone Nord',
        'notes' => 'Commande test',
    ]);
}

   public function test_commercial_can_update_commande()
{
    $user = User::factory()->create(['role' => 'commercial']);
    $commande = Commande::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user);

    $response = $this->put("/mes-commandes/{$commande->id}", [
        'numero_facture' => $commande->numero_facture,
        'pharmacy_id' => $commande->pharmacy_id,
        'quantite' => 20,
        'statut' => 'envoye',
        'date' => $commande->date,
        'zone_geographique' => $commande->zone_geographique,
        'notes' => 'Mise à jour',
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('commandes', [
        'id' => $commande->id,
        'quantite' => 20,
        'statut' => 'envoye',
    ]);
}

    public function test_admin_can_view_all_commandes()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $commande = Commande::factory()->create();

        $this->actingAs($admin);

        $response = $this->get('/admin/commandes');

        $response->assertStatus(200);
        $response->assertSee($commande->numero_facture);
    }

    public function test_commercial_can_view_own_commandes()
{
    $user = User::factory()->create(['role' => 'commercial']);
    $commande = Commande::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user);

    $response = $this->get('/mes-commandes');

    $response->assertStatus(200);
    
    // Check for multiple pieces of data to ensure the commande is displayed
    $response->assertSee($commande->pharmacy->name); // Assuming pharmacy has a name
    $response->assertSee($commande->quantite);
    $response->assertSee($commande->statut);
}


}

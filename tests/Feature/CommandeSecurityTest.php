<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Commande;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommandeSecurityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_access_mes_commandes()
    {
        $response = $this->get('/mes-commandes');
        $response->assertRedirect('/login');
    }

    /** @test */
    public function guest_cannot_access_create_commande_form()
    {
        $response = $this->get('/mes-commandes/nouveau');
        $response->assertRedirect('/login');
    }

    /** @test */
    public function guest_cannot_access_edit_commande()
    {
        $commande = Commande::factory()->create();
        $response = $this->get("/mes-commandes/modifier/{$commande->id}");
        $response->assertRedirect('/login');
    }


    /** @test */
    public function non_admin_cannot_view_all_commandes()
    {
        $user = User::factory()->create(['role' => 'commercial']);

        $this->actingAs($user)
            ->get('/admin/commandes') // Changez cette route si elle est différente
            ->assertForbidden();
    }

    /** @test */
    public function post_commande_fails_without_csrf_token()
    {
        $user = User::factory()->create(['role' => 'commercial']);

        $response = $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class)
            ->actingAs($user)
            ->post('/mes-commandes', [
                'quantite' => 10,
                'pharmacy_id' => 1,
                'zone_geographique' => 'Nord',
                'numero_facture' => 'CMD999',
                'date' => now(),
            ]);

        $this->assertNotEquals(419, $response->getStatusCode(), 'Expected CSRF token error.');
    }
}

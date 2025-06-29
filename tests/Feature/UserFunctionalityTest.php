<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserFunctionalityTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_be_created()
    {
        $user = User::factory()->create([
            'prenom' => 'Jean',
            'nom' => 'Dupont',
            'email' => 'jean@example.com',
            'mot_de_passe_hash' => Hash::make('password'),
            'role' => 'commercial',
        ]);

        $this->assertDatabaseHas('users', ['email' => 'jean@example.com']);
    }

   public function test_user_can_login()
{
    $user = \App\Models\User::factory()->create([
        'email' => 'test@example.com',
        'mot_de_passe_hash' => Hash::make('password'),
        'role' => 'commercial',
    ]);

    $response = $this->post('/login', [
        'email' => 'test@example.com',
        'password' => 'password', 
    ]);

    $this->assertAuthenticatedAs($user); 
    $response->assertRedirect(); 
}

    public function test_admin_can_access_admin_dashboard()
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'mot_de_passe_hash' => Hash::make('adminpass'),
        ]);

        $this->actingAs($admin)
             ->get('/admin/dashboard')
             ->assertStatus(200);
    }

    public function test_commercial_can_access_commercial_dashboard()
    {
        $commercial = User::factory()->create([
            'role' => 'commercial',
            'mot_de_passe_hash' => Hash::make('testpass'),
        ]);

        $this->actingAs($commercial)
             ->get('/commercial/dashboard')
             ->assertStatus(200);
    }

    public function test_user_can_update_account_info()
    {
        $user = User::factory()->create([
            'mot_de_passe_hash' => Hash::make('oldpass'),
            'role' => 'commercial',
        ]);

        $this->actingAs($user)->post('/mon-compte', [
            'prenom' => 'Nouveau',
            'nom' => 'Nom',
            'email' => 'newemail@example.com',
            'role' => 'commercial',
        ])->assertRedirect();

        $this->assertDatabaseHas('users', ['email' => 'newemail@example.com']);
    }

public function test_user_can_change_password()
{
    $user = User::factory()->create([
        'mot_de_passe_hash' => Hash::make('oldpassword'),
        'role' => 'commercial',
    ]);

    $this->actingAs($user);

    $response = $this->post('/mon-compte/mot-de-passe', [
        'current_password' => 'oldpassword',
        'password' => 'newpassword',
        'password_confirmation' => 'newpassword',
    ]);

    $response->assertRedirect();

    $this->assertTrue(Hash::check('newpassword', $user->fresh()->mot_de_passe_hash));
}



}

<?php

namespace Tests\Feature;

use App\Models\Administrateur;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_register()
    {
        $response = $this->postJson("/api/inscription", [
            "name" => "John Doe",
            "email" => "john.doe@gmail.com",
            "password" => "John@doe1",
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                "id",
                "name",
                "email",
                "created_at",
                "updated_at"
            ]);
    }

    public function test_admin_cannot_register_with_invalid_credentials()
    {
        $response = $this->postJson("/api/inscription", [
            "name" => "John Doe",
            "email" => "john.doe@gmail",
            "password" => "John@doe",
        ]);

        $response->assertStatus(422);
    }

    public function test_admin_can_login()
    {
        $admin = Administrateur::factory()->create([]);

        $response = $this->postJson('/api/connexion', [
            "email" => $admin->email,
            "password" => "John@doe1"
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                "token",
            ]);
    }

    public function test_admin_cannot_login_with_invalid_credentials()
    {
        $response = $this->postJson('/api/connexion', [
            "email" => 'wrong@example.com',
            "password" => "wrongpassword",
        ]);

        $response->assertStatus(401);
    }
}

<?php

namespace Tests\Feature;

use App\Enums\ProfilStatutEnum;
use App\Models\Administrateur;
use App\Models\Profil;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProfilTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_active_profils_are_returned()
    {
        Profil::factory()->create(["statut" => ProfilStatutEnum::ACTIF]);
        Profil::factory()->create(["statut" => ProfilStatutEnum::ACTIF]);
        Profil::factory()->create(["statut" => ProfilStatutEnum::INACTIF]);
        Profil::factory()->create(["statut" => ProfilStatutEnum::EN_ATTENTE]);

        $response = $this->getJson("/api/profils");

        $response->assertStatus(200);

        // retourne 2 profils actifs
        $response->assertJsonCount(2);
    }

    public function test_create_profil_without_image()
    {
        $admin = Administrateur::factory()->create();
        $token = $admin->createToken("TestToken")->plainTextToken;

        $response = $this->postJson("/api/profils", [
            "nom" => "ait ouaret",
            "prenom" => "massinssa",
            "statut" => ProfilStatutEnum::EN_ATTENTE
        ], [
            "accept" => "application/json",
            "Authorization" => "Bearer " . $token
        ]);

        $response->assertStatus(200);
    }

    public function test_create_profil_with_image()
    {
        $admin = Administrateur::factory()->create();
        $token = $admin->createToken("TestToken")->plainTextToken;

        $file = UploadedFile::fake()->image("avatar.jpg");

        $response = $this->postJson("/api/profils", [
            "nom" => "ait ouaret",
            "prenom" => "massinssa",
            "image" => $file,
            "statut" => ProfilStatutEnum::EN_ATTENTE
        ], [
            "accept" => "application/json",
            "Authorization" => "Bearer " . $token
        ]);

        $response->assertStatus(200);
    }

    public function test_delete_profil()
    {
        $admin = Administrateur::factory()->create();
        $token = $admin->createToken("TestToken")->plainTextToken;

        $profil = Profil::factory()->create([
            "administrateur_id" => $admin->id,
        ]);

        $response = $this->deleteJson("/api/profils/" . $profil->id, [], [
            "accept" => "application/json",
            "Authorization" => "Bearer " . $token,
        ]);

        $response->assertStatus(200);

        // tester si le profil a été supprimé (softdelete)
        $this->assertSoftDeleted("profils", [
            "id" => $profil->id,
        ]);
    }

    public function test_admin_can_update_profil()
    {
        $admin = Administrateur::factory()->create();
        $token = $admin->createToken("TestToken")->plainTextToken;

        // Profil à modifier
        $profil = Profil::factory()->create([
            "administrateur_id" => $admin->id,
            "nom" => "Doe",
            "prenom" => "John",
            "statut" => ProfilStatutEnum::ACTIF
        ]);

        // Données à mettre à jour
        $mise_a_jour = [
            "nom" => "Will",
            "prenom" => "Smith",
            "statut" => ProfilStatutEnum::EN_ATTENTE
        ];

        $response = $this->putJson("/api/profils/" . $profil->id, $mise_a_jour, [
            "accept" => "application/json",
            "Authorization" => "Bearer " . $token,
        ]);

        $response->assertStatus(200);

        // Vérifier que le profil a bien été mis à jour dans la base de données
        $this->assertDatabaseHas("profils", [
            "id" => $profil->id,
            "nom" => "Will",
            "prenom" => "Smith",
            "statut" => ProfilStatutEnum::EN_ATTENTE
        ]);
    }
}

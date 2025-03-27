<?php

namespace Tests\Feature;

use App\Models\Administrateur;
use App\Models\Profil;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentaireTest extends TestCase
{
    public function test_admin_can_add_comment_to_profil()
    {
        $admin = Administrateur::factory()->create();
        $profil = Profil::factory()->create();

        $token = $admin->createToken("TestToken")->plainTextToken;

        // poster le commentaire
        $response = $this->postJson("/api/commentaires/", [
            "contenu" => "Ceci est un commentaire",
            "profil_id" => $profil->id,
            "administrateur_id" => $admin->id,
        ], [
            "accept" => "application/json",
            "Authorization" => "Bearer " . $token,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                "contenu", "administrateur_id", "profil_id", "created_at", "updated_at"
            ]);

        $this->assertDatabaseHas("commentaires", [
            "contenu" => "Ceci est un commentaire",
            "administrateur_id" => $admin->id,
            "profil_id" => $profil->id,
        ]);
    }

    public function test_admin_cannot_add_multiple_comments_on_same_profil()
    {
        $admin = Administrateur::factory()->create();
        $profil = Profil::factory()->create();

        $token = $admin->createToken("TestToken")->plainTextToken;

        // poster un commentaire
        $this->postJson("/api/commentaires/", [
            "contenu" => "Ceci est un commentaire",
            "profil_id" => $profil->id,
            "administrateur_id" => $admin->id,
        ], [
            "accept" => "application/json",
            "Authorization" => "Bearer " . $token,
        ]);

        // poster un autre commentaire sur le meme profil
        $response = $this->postJson("/api/commentaires/", [
            "contenu" => "Ceci est un autre commentaire",
            "profil_id" => $profil->id,
            "administrateur_id" => $admin->id,
        ], [
            "accept" => "application/json",
            "Authorization" => "Bearer " . $token,
        ]);

        // retourne une erreur de validation (un admin ne peut pas poster plus d'un commentaire sur le meme profil)
        $response->assertStatus(422);
    }
}

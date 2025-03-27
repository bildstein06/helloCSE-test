<?php

namespace Database\Factories;

use App\Enums\ProfilStatutEnum;
use App\Models\Administrateur;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfilFactory extends Factory
{
    public function definition(): array
    {
        return [
            "nom" => $this->faker->lastName,
            "prenom" => $this->faker->firstName,
            "image" => $this->faker->image(null, 640, 480, "avatar", false),
            "statut" => ProfilStatutEnum::EN_ATTENTE,
            "administrateur_id" => Administrateur::factory()->create()->id,

        ];
    }
}

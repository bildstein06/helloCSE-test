<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreerProfilRequest;
use App\Http\Requests\ModifierProfilRequest;
use App\Services\ProfilService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class ProfilController extends Controller
{
    protected $profilService;

    public function __construct(ProfilService $profilService)
    {
        $this->profilService = $profilService;
    }

    public function getProfils(Request $request): JsonResponse
    {
        return response()->json($this->profilService->getProfils(), 200);
    }

    public function creerProfil(CreerProfilRequest $request): JsonResponse
    {
        $profil = $this->profilService->creerProfil($request->validated());
        return response()->json(["profil" => $profil], 200);
    }

    public function modifierProfil(int $id, ModifierProfilRequest $request): JsonResponse
    {
        $profil = $this->profilService->modifierProfil($id, $request->validated());

        if($profil === null)
        {
            return response()->json(["erreur" => "Profil $id introuvable"], 404);
        }
        else
        {
            return response()->json(["message" => $profil], 200);
        }

    }

    public function supprimerProfil(int $id): JsonResponse
    {
        if($this->profilService->supprimerProfil($id) === null)
        {
            return response()->json(["erreur" => "Profil $id introuvable"], 404);
        }
        else
        {
            return response()->json(["message" => "Profil $id supprimé"], 200);
        }

    }
}

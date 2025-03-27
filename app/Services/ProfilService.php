<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Administrateur;
use App\Models\Profil;
use App\Repositories\AdminRepository;
use App\Repositories\ProfilRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

Class ProfilService {

    protected $profilRepository;

    public function __construct(ProfilRepository $profilRepository)
    {
        $this->profilRepository = $profilRepository;
    }

    public function getProfils(): Collection
    {
        return $this->profilRepository->getAll();
    }

    public function creerProfil(array $data): Profil
    {
        return $this->profilRepository->creerProfil($data);
    }

    public function modifierProfil(int $id, array $data): ?Profil
    {
        return $this->profilRepository->modifierProfil($id, $data);
    }

    public function supprimerProfil(int $id): ?int
    {
        return $this->profilRepository->supprimerProfil($id);
    }

}

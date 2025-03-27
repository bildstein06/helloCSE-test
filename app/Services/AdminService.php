<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Administrateur;
use App\Repositories\AdminRepository;
use Illuminate\Support\Facades\Hash;

Class AdminService {

    protected $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function inscription(array $data): Administrateur
    {
        return $this->adminRepository->inscription($data);
    }

    public function connexion(array $data): ?string
    {
        $admin = $this->adminRepository->getAdminByEmail($data["email"]);

        if ($admin != null && Hash::check($data["password"], $admin->password))
        {
            return $admin->createToken('API Token')->plainTextToken;
        }

        return null;
    }
}

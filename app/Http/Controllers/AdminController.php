<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AdminConnexionRequest;
use App\Http\Requests\AdminInscriptionRequest;
use App\Models\Administrateur;
use App\Services\AdminService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function inscription(AdminInscriptionRequest $request): JsonResponse
    {
        $admin = $this->adminService->inscription($request->validated());
        return response()->json($admin, 200);
    }

    public function connexion(AdminConnexionRequest $request): JsonResponse
    {
        $token = $this->adminService->connexion($request->validated());

        if($token !== null)
        {
            return response()->json(["token" => $token], 200);
        }
        else
        {
            return response()->json(["message" => "Email et/ou mot de passe incorrects"], 401);
        }
    }


}

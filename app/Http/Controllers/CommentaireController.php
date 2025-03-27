<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CommentaireRequest;
use App\Services\CommentaireService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class commentaireController extends Controller
{
    protected $commentaireService;

    public function __construct(CommentaireService $commentaireService)
    {
        $this->commentaireService = $commentaireService;
    }

    public function posterCommentaire(CommentaireRequest $request): JsonResponse
    {
        $commentaire = $this->commentaireService->posterCommentaire($request->validated());
        return response()->json($commentaire, 200);
    }
}

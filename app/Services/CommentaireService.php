<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Administrateur;
use App\Models\Commentaire;
use App\Repositories\CommentaireRepository;

Class CommentaireService {

    protected $commentaireRepository;

    public function __construct(CommentaireRepository $commentaireRepository)
    {
        $this->commentaireRepository = $commentaireRepository;
    }

    public function posterCommentaire(array $data): Commentaire
    {
        return $this->commentaireRepository->posterCommentaire($data);
    }
}

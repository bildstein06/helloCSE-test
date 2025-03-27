<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Commentaire;

Class CommentaireRepository {

 public function posterCommentaire(array $data): Commentaire
 {
    $commentaire = new Commentaire();

    $commentaire->contenu = $data['contenu'];
    $commentaire->administrateur_id = $data['administrateur_id'];
    $commentaire->profil_id = $data['profil_id'];

    $commentaire->save();

    return $commentaire;
 }
}

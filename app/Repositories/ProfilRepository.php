<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Enums\ProfilStatutEnum;
use App\Models\Profil;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

 Class ProfilRepository {

     public function getProfilById(int $id): ?Profil
     {
         return Profil::find($id);
     }

     public function getAll(): Collection
     {
         return Profil::select("id", "nom", "prenom", "image", "administrateur_id", "created_at")->with(["administrateur" => function($query) {
             $query->select("id", "name", "email");
         }])->where("statut", ProfilStatutEnum::ACTIF)->get();
     }

     public function creerProfil(array $data): Profil
     {
         // Un try catch pour s'assurer que le stockage du fichier et l'ajout du profil fonctionne simultanément
         // Cela permet d'eviter d'inserer un profil s'il y a erreur danss le systeme de fichier
         try {
             $profil = new Profil();

             $profil->nom = $data["nom"];
             $profil->prenom = $data["prenom"];
             $profil->statut = $data["statut"];
             $profil->administrateur_id = $data["administrateur_id"];

             // Stockage du fichier s'il est inclu dans la requete
             if (isset($data["image"])) {
                 $filename = Storage::disk("hellocse")->put("", $data["image"]);
                 $profil->image = $filename;
             }

             $profil->save();

             return $profil;
         }
         catch (\Exception $e)
         {
            return $e->getMessage();
         }

     }

     public function modifierProfil($id, array $data): ?Profil
     {
         $profil = $this->getProfilById($id);

         if($profil === null)
         {
             return null;
         }
         else
         {
             // Un try catch pour s'assurer que le stockage du fichier et l'ajout du profil fonctionne simultanément
             // Cela permet d'eviter d'inserer un profil s'il y a erreur danss le systeme de fichier

             try {

                 $profil->nom = isset($data["nom"]) ? $data["nom"] : $profil->nom;
                 $profil->prenom = isset($data["prenom"]) ? $data["prenom"] : $profil->prenom;
                 $profil->statut = isset($data["statut"]) ? $data["statut"] : $profil->statut;
                 $profil->administrateur_id = $data["administrateur_id"];

                 // Stockage du fichier s'il est inclu dans la requete
                 if (isset($data["image"])) {
                     // suppression de l'ancienne image si elle existe
                     if($profil->image !== null)
                     {
                         Storage::disk("hellocse")->delete($profil->image);
                     }
                     // remplacer l'ancienne image par la nouvelle
                     $filename = Storage::disk("hellocse")->put("", $data["image"]);
                     $profil->image = $filename;
                 }

                 $profil->save();

                 return $profil;
             }
             catch (\Exception $e)
             {
                return $e->getMessage();
             }
         }


     }

     public function supprimerProfil($id): ?int
     {
         $profil = $this->getProfilById($id);

         if($profil === null)
         {
             return null;
         }
         else
         {
             try {
                 // c'est un soft delete, donc pas besoin de supprimer l'image du profil

                 /*if($profil->image !== null)
                 {
                     Storage::disk("hellocse")->delete($profil->image);
                 }*/

                 // sofdelete
                 Profil::destroy($id);

                 return $id;
             }
             catch (\Exception $e)
             {
                 return $e->getMessage();
             }
         }

     }

 }

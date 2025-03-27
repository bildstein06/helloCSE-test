<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Enums\ProfilStatutEnum;
use App\Models\Profil;
use Illuminate\Support\Facades\Storage;

 Class ProfilRepository {

     public function getProfilById(int $id): ?Profil
     {
         return Profil::find($id);
     }

     public function getAll(): Profil
     {
         return Profil::select("id", "nom", "prenom", "image", "administrateur_id", "created_at")->with(["administrateur" => function($query) {
             $query->select("id", "name", "email");
         }])->where("statut", ProfilStatutEnum::ACTIF)->get();
     }

     public function creerProfil(array $data): Profil
     {
         try {
             $profil = new Profil();

             $profil->nom = $data["nom"];
             $profil->prenom = $data["prenom"];
             $profil->statut = $data["statut"];
             $profil->administrateur_id = $data["administrateur_id"];

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
             try {

                 $profil->nom = isset($data["nom"]) ? $data["nom"] : $profil->nom;
                 $profil->prenom = isset($data["prenom"]) ? $data["prenom"] : $profil->prenom;
                 $profil->statut = isset($data["statut"]) ? $data["statut"] : $profil->statut;
                 $profil->administrateur_id = $data["administrateur_id"];

                 if (isset($data["image"])) {
                     if($profil->image !== null)
                     {
                         Storage::disk("hellocse")->delete($profil->image);
                     }
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

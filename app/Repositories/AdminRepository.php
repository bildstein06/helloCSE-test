<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Http\Requests\AdminInscriptionRequest;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Hash;

 Class AdminRepository {

     public function getAdminByEmail(string $email): ?Administrateur
     {
         return Administrateur::where("email", $email)->first();
     }

     public function inscription(array $data): string
     {
         $admin = new Administrateur();

         $admin->name = $data["name"];
         $admin->email = $data["email"];
         $admin->password = Hash::make($data["password"]);

         $admin->save();

         return $admin;
     }

 }

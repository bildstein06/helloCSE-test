<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Administrateur extends Authenticatable
{
    use HasFactory, HasApiTokens;
    protected $hidden = [
        'password'
    ];
    public function profils()
    {
        return $this->hasMany(Profil::class);
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }
}

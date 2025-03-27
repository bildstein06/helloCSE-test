<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Commentaire extends Model
{
    use HasFactory, HasApiTokens;

    public function administrateur()
    {
        return $this->belongsTo(Administrateur::class);
    }

    public function profil()
    {
        return $this->belongsTo(Profil::class);
    }
}

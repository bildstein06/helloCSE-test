<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Profil extends Model
{
    use HasFactory, SoftDeletes, HasApiTokens;

    public function administrateur()
    {
        return $this->belongsTo(Administrateur::class);
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }
}

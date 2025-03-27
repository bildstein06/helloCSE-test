<?php

namespace App\Enums;

enum ProfilStatutEnum: string
{
    case INACTIF = 'inactif';
    case EN_ATTENTE = 'en_attente';
    case ACTIF = 'actif';
}

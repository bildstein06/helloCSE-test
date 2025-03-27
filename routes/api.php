<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    Route::post('/profils', 'ProfilController@creerProfil')->name("creerProfil");
    Route::delete('/profils/{id}', 'ProfilController@supprimerProfil')->name("supprimerProfil");
    Route::put('/profils/{id}', 'ProfilController@modifierProfil')->name("modifierProfil");
    Route::post('/commentaires', 'CommentaireController@posterCommentaire')->name("posterCommentaire");
});

Route::middleware(['throttle:60,1'])->group(function () {
    Route::post('/connexion', 'AdminController@connexion')->name("connexion");
    Route::post('/inscription', 'AdminController@inscription')->name("inscription");
    Route::get('/profils', 'ProfilController@getProfils')->name("getProfils");
});

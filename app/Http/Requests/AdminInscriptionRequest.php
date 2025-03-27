<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\EmailValide;
use Illuminate\Validation\Rules\Password;

class AdminInscriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => "required|string",
            "email" => ["required", new EmailValide(), "unique:administrateurs"], // J'ai utilisé une regle personnalisé pour la validation de mail (celle de laravel est incomplete)
            'password' => [
                'required',
                Password::min(8) // Mot de passe fort
                    ->letters()     // Doit contenir des lettres
                    ->mixedCase()   // Doit contenir des majuscules et minuscules
                    ->numbers()     // Doit contenir des chiffres
                    ->symbols(),    // Doit contenir des caractères spéciaux
            ],
        ];
    }
}

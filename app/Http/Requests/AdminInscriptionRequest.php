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
            "email" => ["required", new EmailValide(), "unique:administrateurs"],
            'password' => [
                'required',
                Password::min(8)
                    ->letters()     // Doit contenir des lettres
                    ->mixedCase()   // Doit contenir des majuscules et minuscules
                    ->numbers()     // Doit contenir des chiffres
                    ->symbols(),    // Doit contenir des caractères spéciaux
            ],
        ];
    }
}

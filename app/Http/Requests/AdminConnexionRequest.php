<?php
namespace App\Http\Requests;

use App\Rules\EmailValide;
use Illuminate\Foundation\Http\FormRequest;

class AdminConnexionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // J'ai utilisé une regle personnalisé pour la validation de mail (celle de laravel est incomplete)
            "email"  => ["required", new EmailValide()],
            "password"  => "required",
        ];
    }
}

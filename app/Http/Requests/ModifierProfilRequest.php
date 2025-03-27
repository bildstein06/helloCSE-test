<?php
namespace App\Http\Requests;

use App\Enums\ProfilStatutEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\PersonalAccessToken;

class ModifierProfilRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        // Récupérer l'id de l'admin a partir du token du header
        $this->merge([
            "administrateur_id" => PersonalAccessToken::findToken($this->bearerToken())->tokenable_id,
        ]);
    }


    public function rules(): array
    {
        return [
            "administrateur_id" => "",
            "nom" => "string",
            "prenom" => "string",
            "image" => "nullable|image|max:2048",
            "statut" => [Rule::in(array_column(ProfilStatutEnum::cases(), "value"))],
        ];
    }
}

<?php
namespace App\Http\Requests;

use App\Enums\ProfilStatutEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\PersonalAccessToken;

class CommentaireRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            "administrateur_id" => PersonalAccessToken::findToken($this->bearerToken())->tokenable_id,
        ]);
    }

    public function rules(): array
    {
        return [
            "profil_id" => ["required", Rule::exists("profils", "id")],

            "administrateur_id" => ["required", Rule::unique("commentaires")
                ->where(function ($query) {
                    return $query->where('profil_id', $this->input('profil_id'));
                })],

            "contenu" => "required|string",
        ];
    }

    public function messages(): array
    {
        return [
            "administrateur_id.unique" => "Un admin ne peux pas poster plus d'un commentaire sur le meme profil.",
        ];
    }
}

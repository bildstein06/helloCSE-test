<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmailValide implements Rule
{

    public function passes($attribute, $value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public function message()
    {
        return trans('validation.email');
    }
}

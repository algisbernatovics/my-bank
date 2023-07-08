<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class ValidPersonalCodeAtRegister implements Rule
{
    public function passes($attribute, $value): bool
    {
        $numericString = preg_replace('/\D/', '', $value);

        if (preg_match('/^\d{11}$/', $numericString)) {

            $value = substr_replace($numericString, "-", 6, 0);

            $exist = User::where('personal_code', '=', $value)->exists();
            if (!$exist) {
                return true;
            }
        }
        return false;
    }

    public function message(): string
    {
        return "Personal code must be xxxxxx-xxxxx and unique.";
    }
}

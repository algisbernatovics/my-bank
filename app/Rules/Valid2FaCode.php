<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\TwoFactorAuthenticationProvider;

class Valid2FaCode implements Rule
{
    public function passes($attribute, $value): bool
    {
        $codeIsValid = app(TwoFactorAuthenticationProvider::class)
            ->verify(decrypt(Auth::user()['two_factor_secret']), $value);

        if ($codeIsValid) {
            return true;
        } else {
            return false;
        }
    }

    public function message(): string
    {
        return "2FA Code invalid.";
    }
}

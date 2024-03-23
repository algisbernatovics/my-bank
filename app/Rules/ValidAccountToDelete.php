<?php

namespace App\Rules;

use App\Models\Account;
use App\Services\AccountBalance;
use Illuminate\Contracts\Validation\Rule;

class ValidAccountToDelete implements Rule
{
    public function passes($attribute, $value): bool
    {
        $existAccount = Account::where('acc_number', '=', $value)
            ->exists();
        if ($existAccount) {
            $balance = (new AccountBalance($value))->getBalance();
        }
        return ($balance == 0);
    }

    public function message(): string
    {
        return "Account balance must be 0.";
    }

}

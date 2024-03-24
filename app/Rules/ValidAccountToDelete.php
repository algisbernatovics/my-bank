<?php

namespace App\Rules;

use App\Models\Account;
use App\Services\AccountBalance;
use Illuminate\Contracts\Validation\Rule;

class ValidAccountToDelete implements Rule
{
    public function passes($attribute, $value): bool
    {
        $account = Account::where('acc_number', $value)->first();
        $balance = $account->balance();

        return ($balance == 0);
    }

    public function message(): string
    {
        return "Account balance must be 0.";
    }

}

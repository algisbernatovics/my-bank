<?php

namespace App\Rules;

use App\Models\Account;
use Illuminate\Contracts\Validation\Rule;

class ValidTargetAccount implements Rule
{
    protected string $sourceAccount;

    public function __construct(string $sourceAccount)
    {
        $this->sourceAccount = $sourceAccount;
    }

    public function passes($attribute, $value): bool
    {
        $notSame = ($value !== $this->sourceAccount);
        $exist = Account::where('acc_number', '=', $value)
            ->exists();

        return ($notSame and $exist);
    }

    public function message(): string
    {
        return "The source account cannot be the recipient account or does not exist.";
    }
}

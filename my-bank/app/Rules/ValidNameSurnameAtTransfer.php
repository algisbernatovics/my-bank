<?php

namespace App\Rules;

use App\Models\Accounts;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class ValidNameSurnameAtTransfer implements Rule
{
    protected string $targetAccountNumber;

    public function __construct(string $targetAccountNumber)
    {
        $this->targetAccountNumber = $targetAccountNumber;
    }

    public function passes($attribute, $value): bool
    {
        $targetAccountExist = Accounts::where('acc_number', '=', $this->targetAccountNumber)
            ->exists();

        if ($targetAccountExist) {

            $targetAccount = Accounts::where('acc_number', '=', $this->targetAccountNumber)
                ->first();

            $targetAccountUser = User::where('id', '=', $targetAccount->user_id)
                ->first();

            $userName = $targetAccountUser->name;
            $userSurname = $targetAccountUser->surname;

            $parts = explode(' ', $value);

            if ($parts[0] === $userName and $parts[1] === $userSurname) {
                return true;
            }
        }
        return false;
    }

    public function message(): string
    {
        return "Beneficiary details are incorrect.";
    }
}

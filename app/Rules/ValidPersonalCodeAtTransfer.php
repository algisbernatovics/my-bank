<?php

namespace App\Rules;

use App\Models\Accounts;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class ValidPersonalCodeAtTransfer implements Rule
{
    protected string $inputAccount;
    protected Accounts $targetAccount;
    protected User $targetAccountUser;

    public function __construct(string $inputAccount)
    {
        $this->inputAccount = $inputAccount;

        $existAccount = Accounts::where('acc_number', '=', $this->inputAccount)
            ->exists();

        if ($existAccount) {

            $this->targetAccount = Accounts::where('acc_number', '=', $this->inputAccount)
                ->first();
            $this->targetAccountUser = User::where('id', '=', $this->targetAccount->user_id)
                ->first();
        }
    }

    public function passes($attribute, $value): bool
    {
        if (isset($this->targetAccountUser->personal_code)) {
            return ($value === $this->targetAccountUser->personal_code);
        } else {
            return false;
        }
    }

    public function message(): string
    {
        return "The personal code details are incorrect.";
    }
}

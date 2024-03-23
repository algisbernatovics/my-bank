<?php

namespace App\Rules;

use App\Models\Account;
use App\Services\AccountBalance;
use Illuminate\Contracts\Validation\Rule;

class ValidTransferAmount implements Rule
{
    protected Account $targetAccount;
    protected float $targetAccountFunds;
    protected string $targetAccountCurrency;

    public function __construct(Account $targetAccount)
    {
        $this->targetAccount = $targetAccount;
        $this->targetAccountFunds = ((new AccountBalance($targetAccount->acc_number))->getBalance()) / 100;
        $this->targetAccountCurrency = $targetAccount->currency;
    }

    public function passes($attribute, $value): bool
    {
        return $value >= 0.01 && $value <= $this->targetAccountFunds;
    }

    public function message(): string
    {
        return "The transfer amount must be between 0.01 and $this->targetAccountFunds $this->targetAccountCurrency.";
    }
}

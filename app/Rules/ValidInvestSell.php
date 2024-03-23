<?php

namespace App\Rules;

use App\Models\Account;
use App\Services\AccountInvestments;
use Illuminate\Contracts\Validation\Rule;

class ValidInvestSell implements Rule
{
    protected string $symbol;
    protected float $accountInvestments;

    protected float $amount;

    public function __construct(Account $investmentAccount, string $symbol, float $amount)
    {
        $this->amount = $amount;
        $this->investmentAccount = $investmentAccount;

        $this->accountInvestments = (new AccountInvestments($investmentAccount->acc_number, $symbol))->getAmount();

        $this->symbol = $symbol;
    }

    public function passes($attribute, $value): bool
    {
        return $this->accountInvestments / 100000 > 0 && ($this->accountInvestments / 100000 >= $value);
    }

    public function message(): string
    {
        return redirect()->back()->with("$this->symbol" . 'sell', "You dont have $this->amount $this->symbol");
    }
}


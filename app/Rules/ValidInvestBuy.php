<?php

namespace App\Rules;

use App\Models\Account;
use App\Services\AccountBalance;
use Illuminate\Contracts\Validation\Rule;

class ValidInvestBuy implements Rule
{
    protected Account $investmentAccount;
    protected float $investmentAccountFunds;
    protected string $investmentAccountCurrency;
    protected string $symbol;
    protected float $amount;
    protected float $inTotal;

    public function __construct(Account $investmentAccount, float $price, string $symbol, float $amount)
    {
        $this->investmentAccount = $investmentAccount;
        $this->investmentAccountFunds = (new AccountBalance($investmentAccount->acc_number))->getBalance();
        $this->amount = $amount;
        $this->investmentAccountCurrency = $investmentAccount->currency;
        $this->symbol = $symbol;
        $this->inTotal = $amount * $price;
    }

    public function passes($attribute, $value): bool
    {
        return $this->inTotal > 0 && $this->inTotal <= $this->investmentAccountFunds;
    }

    public function message(): string
    {
        return redirect()->back()->with("$this->symbol" . 'buy', "$this->amount $this->symbol price is $this->inTotal  $this->investmentAccountCurrency");
    }
}

<?php

namespace App\Services;

use App\Models\Investments;

class AccountInvestments
{
    protected float $amount;

    public function __construct(string $account, string $symbol)
    {
        $buy_amount = Investments::where('account', '=', $account)
            ->where('symbol', '=', $symbol)
            ->sum('buy_amount');

        $sell_amount = Investments::where('account', '=', $account)
            ->where('symbol', '=', $symbol)
            ->sum('sell_amount');

        $this->amount = ($buy_amount - $sell_amount);
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}

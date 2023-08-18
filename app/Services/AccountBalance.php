<?php

namespace App\Services;

use App\Models\Transactions;

class AccountBalance
{
    protected float $funds;

    public function __construct(string $account)
    {
        $independencys = (Transactions::where('to', '=', $account)
            ->sum('converted_amount'));

        $expenses = (Transactions::where('from', '=', $account)
            ->sum('transfer_amount'));

        $this->funds = ($independencys - $expenses);
    }

    public function getBalance(): float
    {
        return $this->funds;
    }
}

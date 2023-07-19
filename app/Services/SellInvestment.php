<?php

namespace App\Services;

use App\Models\Accounts;
use App\Models\Investments;
use App\Models\Transactions;
use Illuminate\Http\Request;

class SellInvestment
{
    public function execute(Request $request, float $price, string $symbol, string $acc_number)
    {
        $inTotal = $request->amount * $price * 100;

        $sourceAccount = Accounts::where('acc_number', '=', $acc_number)
            ->first();

        $transaction = new Transactions();
        $transaction->from = NULL;
        $transaction->to = $sourceAccount->acc_number;
        $transaction->transfer_amount = NULL;
        $transaction->converted_amount = $inTotal;
        $transaction->type = 'Investment Sell';
        $transaction->save();

        $investment = new Investments();
        $investment->account = $sourceAccount->acc_number;
        $investment->symbol = $symbol;
        $investment->sell_amount = (float)$request->amount * 100000;
        $investment->buy_amount = NULL;
        $investment->save();
    }
}

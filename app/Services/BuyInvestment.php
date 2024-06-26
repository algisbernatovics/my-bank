<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Investments;
use App\Models\Transaction;
use Illuminate\Http\Request;

class BuyInvestment
{
    public function execute(Request $request, float $price, string $symbol, string $acc_number)
    {
        $inTotal = $request->amount * $price * 100;

        $sourceAccount = Account::where('acc_number', '=', $acc_number)
            ->first();

        $transaction = new Transaction();
        $transaction->from = $sourceAccount->acc_number;
        $transaction->to = NULL;
        $transaction->transfer_amount = $inTotal;
        $transaction->converted_amount = NULL;
        $transaction->type = 'Investment Buy';
        $transaction->save();

        $investment = new Investments();
        $investment->account = $sourceAccount->acc_number;
        $investment->symbol = $symbol;
        $investment->buy_amount = (float)($request->amount * 100000);
        $investment->sell_amount = NULL;
        $investment->save();
    }
}

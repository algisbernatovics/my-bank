<?php

namespace App\Services;

use App\Models\Accounts;
use App\Models\Transactions;
use Illuminate\Http\Request;

class Transfer
{
    public function execute(Request $request)
    {

        $amountOfFunds = intval($request->amountOfFunds * 100);

        $targetAccount = Accounts::where('acc_number', '=', $request->targetAccount)
            ->first();

        $sourceAccount = Accounts::where('acc_number', '=', $request->sourceAccount)
            ->first();

        $converted = (new CurrencyConvertAPI())->execute
        (
            $amountOfFunds,
            $targetAccount->currency,
            $sourceAccount->currency
        );

        $transaction = new Transactions();

        $transaction->from = $request->sourceAccount;
        $transaction->to = $request->targetAccount;
        $transaction->transfer_amount = $amountOfFunds;
        $transaction->converted_amount = $converted;
        $transaction->type = 'Transfer';

        $transaction->save();

    }
}

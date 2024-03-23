<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Rules\Valid2FaCode;
use App\Rules\ValidNameSurnameAtTransfer;
use App\Rules\ValidPersonalCodeAtTransfer;
use App\Rules\ValidTargetAccount;
use App\Rules\ValidTransferAmount;
use App\Services\AccountBalance;
use App\Services\Transfer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TransferController extends Controller
{
    public function showTransfer(): view
    {
        $existAccounts = Account::where('user_id', '=', Auth::user()['id'])
            ->exists();

        if ($existAccounts) {

            $accounts = Account::where('user_id', '=', Auth::user()['id'])
                ->get();

            foreach ($accounts as $account) {
                $funds = new AccountBalance($account->acc_number);
                $userBankAccounts[] = Collect
                ([
                    'acc_number' => $account->acc_number,
                    'currency' => $account->currency,
                    'type' => $account->type,
                    'balance' => $funds->getBalance()
                ])->toArray();

            }
            return view('transactions.create', ['accounts' => $userBankAccounts]);
        }
        return view('transactions.create');
    }

    public function transferMoney(Request $request): RedirectResponse
    {
        $sourceAccount = Account::where('acc_number', '=', $request->sourceAccount)
            ->first();

        $request->validate([
            'sourceAccount' => ['required', 'string', 'min:32', 'max:32'],
            'targetAccount' => [new ValidTargetAccount($request->sourceAccount)],
            'nameSurname' => [new ValidNameSurnameAtTransfer($request->targetAccount)],
            'personalCode' => [new ValidPersonalCodeAtTransfer($request->targetAccount)],
            'amountOfFunds' => [new ValidTransferAmount($sourceAccount)],
            '2FaCode' => [new Valid2FaCode()],
        ]);

        (new Transfer())->execute($request);

        return redirect("/account/transactions/$sourceAccount->acc_number");
    }
}

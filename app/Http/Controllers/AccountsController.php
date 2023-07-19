<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\Transactions;
use App\Models\User;
use App\Rules\ValidAccountToDelete;
use App\Services\AccountBalance;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AccountsController extends Controller
{
    public function showAccounts(): View
    {
        $existAccounts = Accounts::where('user_id', '=', Auth::user()['id'])->exists();

        if ($existAccounts) {
            $accounts = Accounts::where('user_id', '=', Auth::user()['id'])->get();

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
            return view('accounts.show', ['accounts' => $userBankAccounts]);
        }
        return view('accounts.show');
    }

    public function createAccountForm(): view
    {
        return view('accounts.create');
    }

    public function createAccount(Request $request): RedirectResponse
    {
        sleep(1);
        $newAccountNumber = strtoupper(md5(Auth::user()['personal_code'] . date('r') . time()));
        $account = new Accounts();
        $account->user_id = Auth::user()['id'];
        $account->currency = $request->currency;
        $account->type = $request->type;
        $account->acc_number = $newAccountNumber;
        $account->save();

        $transaction = new Transactions();
        $transaction->from = NULL;
        $transaction->to = $newAccountNumber;
        $transaction->transfer_amount = 0;
        $transaction->converted_amount = 5000000;
        $transaction->type = 'ATM Deposit';
        $transaction->save();

        return redirect("/account/transactions/$newAccountNumber");
    }

    public function showTransactions(string $acc_number): view
    {

        $independencysExist = Transactions::where('from', '=', $acc_number)
            ->exists();

        $expensesExist = Transactions::where('to', '=', $acc_number)
            ->exists();

        if ($independencysExist or $expensesExist) {

            $independencys = Transactions::where('from', '=', $acc_number)
                ->get();

            $expenses = Transactions::where('to', '=', $acc_number)
                ->get();

            $transactions = $independencys
                ->merge($expenses)
                ->sortBy('created_at')
                ->reverse();

            $myAccount = Accounts::where('acc_number', '=', $acc_number)
                ->first();

            foreach ($transactions as $transaction) {

                $accFrom = Accounts::where('acc_number', '=', $transaction->from)
                    ->first();

                $existAccount = Accounts::where('acc_number', '=', $transaction->from)
                    ->exists();

                if ($existAccount) {
                    $userFrom = User::where('id', '=', $accFrom->user_id)
                        ->first();

                } else $userFrom = Auth::user();

                $existAccount = Accounts::where('acc_number', '=', $transaction->to)
                    ->exists();

                $transactionTargetAcc = Accounts::where('acc_number', '=', $transaction->to)
                    ->first();

                if ($existAccount) {

                    $transactionTargetAccUser = User::where('id', '=', $transactionTargetAcc->user_id)
                        ->first();
                } else $transactionTargetAccUser = Auth::user();

                $transactionsHistory[] = collect([

                    'user_from' => $userFrom->name . ' ' . $userFrom->surname,
                    'user_to' => $transactionTargetAccUser->name . ' ' . $transactionTargetAccUser->surname,
                    'account_from' => $transaction->from,
                    'account_to' => $transaction->to,
                    'transfer_amount' => $transaction->transfer_amount,
                    'converted_amount' => $transaction->converted_amount,
                    'type' => $transaction->type,
                    'created_at' => $transaction->created_at,

                ])->toArray();

            }
            return view('transactions.show', ['transactions' => $transactionsHistory, 'myAccount' => $myAccount]);
        }
        return view('transactions.show');
    }

    public function deleteAccount(Request $request): RedirectResponse
    {
        $request->validate
        ([
            'acc_number' => [new ValidAccountToDelete()],
        ]);

        Accounts::where('acc_number', '=', $request->acc_number)->delete();

        return back();
    }
}

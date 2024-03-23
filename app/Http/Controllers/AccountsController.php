<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use App\Rules\ValidAccountToDelete;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AccountsController extends Controller
{
    public function showAccounts(): View
    {
        $user = Auth::user();
        $accounts = $user->accounts;

        return view('accounts.show', ['accounts' => $accounts]);
    }

    public function createAccountForm(): view
    {
        return view('accounts.create');
    }

    public function createAccount(Request $request): RedirectResponse
    {
        sleep(1);

        $newAccountNumber = strtoupper(md5(Auth::user()->personal_code . date('r') . time()));

        $account = new Account();
        $account->user_id = Auth::id();
        $account->currency = $request->currency;
        $account->type = $request->type;
        $account->acc_number = $newAccountNumber;
        $account->save();

        $transaction = new Transaction();
        $transaction->to = $newAccountNumber;
        $transaction->converted_amount = 5000000;
        $transaction->type = 'ATM Deposit';
        $transaction->save();

        return redirect("/account/transactions/$newAccountNumber");
    }


    public function showTransactions(string $acc_number): view
    {

        $independencysExist = Transaction::where('from', '=', $acc_number)
            ->exists();

        $expensesExist = Transaction::where('to', '=', $acc_number)
            ->exists();

        if ($independencysExist or $expensesExist) {

            $independencys = Transaction::where('from', '=', $acc_number)
                ->get();

            $expenses = Transaction::where('to', '=', $acc_number)
                ->get();

            $transactions = $independencys
                ->merge($expenses)
                ->sortBy('created_at')
                ->reverse();

            $myAccount = Account::where('acc_number', '=', $acc_number)
                ->first();

            foreach ($transactions as $transaction) {

                $accFrom = Account::where('acc_number', '=', $transaction->from)
                    ->first();

                $existAccount = Account::where('acc_number', '=', $transaction->from)
                    ->exists();

                if ($existAccount) {
                    $userFrom = User::where('id', '=', $accFrom->user_id)
                        ->first();

                } else $userFrom = Auth::user();

                $existAccount = Account::where('acc_number', '=', $transaction->to)
                    ->exists();

                $transactionTargetAcc = Account::where('acc_number', '=', $transaction->to)
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

        Account::where('acc_number', '=', $request->acc_number)->delete();

        return back();
    }
}

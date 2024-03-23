<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
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
        $account = Account::where('acc_number', $acc_number)->firstOrFail();
        $transactions = $account->getAllTransactions();
        $myAccount = Account::where('acc_number', '=', $acc_number)
            ->first();

        return view('transactions.show', ['transactions' => $transactions, 'myAccount' => $myAccount]);

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

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
    public function list(): View
    {
        $user = Auth::user();
        $accounts = $user->accounts;

        return view('accounts.list', ['accounts' => $accounts]);
    }

    public function create(): view
    {
        return view('accounts.create');
    }

    private function demoDeposit(string $newAccountNumber)
    {
        $transaction = new Transaction();
        $transaction->to = $newAccountNumber;
        $transaction->converted_amount = 5000000;
        $transaction->type = 'ATM Deposit';
        $transaction->save();
    }

    public function store(Request $request): RedirectResponse
    {
        sleep(1);

        $newAccountNumber = strtoupper(md5(Auth::user()->personal_code . date('r') . time()));

        $account = new Account();
        $account->user_id = Auth::id();
        $account->currency = $request->currency;
        $account->type = $request->type;
        $account->acc_number = $newAccountNumber;
        $account->save();

        $this->demoDeposit($newAccountNumber);

        return redirect("/account/transactions/$newAccountNumber");
    }

    public function show(string $acc_number): view
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

<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Rules\ValidInvestBuy;
use App\Rules\ValidInvestSell;
use App\Services\AccountBalance;
use App\Services\BuyInvestment;
use App\Services\CryptoCurrencysAPI;
use App\Services\SellInvestment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class InvestmentController extends Controller
{
    public function showInvestmentAccounts(): view
    {
        $existInvestmentAccounts = Accounts::where('user_id', '=', Auth::user()['id'])
            ->where('type', '=', 'Investment')
            ->exists();

        if ($existInvestmentAccounts) {
            $accounts = Accounts::where('user_id', '=', Auth::user()['id'])
                ->where('type', '=', 'Investment')
                ->get();

            foreach ($accounts as $account) {

                $balance = new AccountBalance($account->acc_number);
                $userInvestmentAccounts[] = Collect
                ([
                    'acc_number' => $account->acc_number,
                    'currency' => $account->currency,
                    'type' => $account->type,
                    'balance' => $balance->getBalance()
                ])->toArray();
            }
            return view('investments.selectAccount',
                [
                    'userInvestmentAccounts' => $userInvestmentAccounts
                ]);
        }
        return view('investments.selectAccount');
    }

    public function showCrypto(string $acc_number): view
    {
        $accountExist = Accounts::where('acc_number', '=', $acc_number)
            ->exists();

        if ($accountExist) {

            $investmentAccount = Accounts::where('acc_number', '=', $acc_number)
                ->first();

            $cryptoCurrencys = (new CryptoCurrencysAPI($investmentAccount))->getCryptoCurrencys();

            return view('investments.create',
                [
                    'cryptoCurrencys' => $cryptoCurrencys,
                    'investmentAccount' => $investmentAccount
                ]);
        }
        return view('investments.create');
    }

    public function buy(string $acc_number, string $symbol, Request $request): RedirectResponse
    {
        $investmentAccount = Accounts::where('acc_number', '=', $acc_number)
            ->first();

        $cryptoCurrencys = (new CryptoCurrencysAPI($investmentAccount))->getCryptoCurrencys();

        foreach ($cryptoCurrencys as $cryptoCurrency) {

            if ($cryptoCurrency['symbol'] === $symbol) {
                $price = $cryptoCurrency['price'];
            }
        }

        $request->validate([
            'amount' => [new ValidInvestBuy($investmentAccount, $price, $symbol, $request->amount)]
        ]);

        (new BuyInvestment())->execute($request, $price, $symbol, $acc_number);

        return back();
    }

    public function sell(string $acc_number, string $symbol, Request $request): RedirectResponse
    {
        $investmentAccount = Accounts::where('acc_number', '=', $acc_number)
            ->first();

        $cryptoCurrencys = (new CryptoCurrencysAPI($investmentAccount))->getCryptoCurrencys();

        foreach ($cryptoCurrencys as $cryptoCurrency) {

            if ($cryptoCurrency['symbol'] === $symbol) {
                $price = $cryptoCurrency['price'];
            }
        }

        $request->validate([
            'amount' => [new ValidInvestSell($investmentAccount, $symbol, $request->amount)]
        ]);

        (new SellInvestment())->execute($request, $price, $symbol, $acc_number);
        return back();
    }
}

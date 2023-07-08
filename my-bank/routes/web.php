<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TransferController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return (new HomeController())->welcome();
});

Route::get('/home', function () {
    return (new HomeController())->home();
})->name('home');

Route::get('/settings', function () {
    return (new SettingsController())->showSettings();
})->middleware(['auth'])->name('settings');

Route::get('/accounts', function () {
    return (new AccountsController())->showAccounts();
})->middleware(['auth'])->name('accounts');

Route::post('/accounts/create', function (Request $request) {
    return (new AccountsController())->createAccount($request);
})->middleware(['auth'])->name('accounts.create');

Route::get('/accounts/create', function () {
    return (new AccountsController())->createAccountForm();
})->middleware(['auth'])->name('accounts.create');

Route::post('/accounts/delete', function (Request $request) {
    return (new AccountsController())->deleteAccount($request);
})->middleware(['auth'])->name('accounts.delete');

Route::get('/account/transactions/{acc_number}', function (string $acc_number) {
    return (new AccountsController())->showTransactions($acc_number);
})->middleware(['auth'])->name('transactions');

Route::get('/transfer', function () {
    return (new TransferController())->showTransfer();
})->middleware(['auth'])->name('transfer');

Route::post('/transfer', function (Request $request) {
    return (new TransferController())->transferMoney($request);
})->middleware(['auth'])->name('transfer');

Route::get('/investmentAccounts', function () {
    return (new InvestmentController())->showInvestmentAccounts();
})->middleware(['auth'])->name('investmentAccounts');

Route::post('/investments/{acc_number}/sell/{symbol}', function (string $acc_number, string $symbol, Request $request) {
    return (new InvestmentController())->sell($acc_number, $symbol, $request);
})->middleware(['auth'])->name('investments.sell');

Route::post('/investments/{acc_number}/buy/{symbol}', function (string $acc_number, string $symbol, Request $request) {
    return (new InvestmentController())->buy($acc_number, $symbol, $request);
})->middleware(['auth'])->name('investments.buy');

Route::get('/investments/{acc_number}', function (string $acc_number) {
    return (new InvestmentController())->showCrypto($acc_number);
})->middleware(['auth'])->name('investments');

require __DIR__ . '/auth.php';

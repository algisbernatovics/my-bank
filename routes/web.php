<?php
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TransferController;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    Route::get('/', [HomeController::class, 'welcome']);

    Route::get('/home', [HomeController::class, 'home'])->name('home');

    Route::get('/settings', [SettingsController::class, 'showSettings'])->name('settings');

    Route::get('/accounts', [AccountsController::class, 'list'])->name('accounts');
    Route::get('/accounts/create', [AccountsController::class, 'create'])->name('accounts.create');
    Route::post('/accounts/store', [AccountsController::class, 'store'])->name('accounts.store');
    Route::post('/accounts/delete', [AccountsController::class, 'deleteAccount'])->name('accounts.delete');
    Route::get('/account/transactions/{acc_number}', [AccountsController::class, 'show'])->name('transactions');

    Route::get('/transfer', [TransferController::class, 'show'])->name('transfer.show');
    Route::post('/transfer/process', [TransferController::class, 'process'])->name('transfer.process');

    Route::get('/investmentAccounts', [InvestmentController::class, 'list'])->name('investmentAccounts');
    Route::post('/investments/{acc_number}/sell/{symbol}', [InvestmentController::class, 'sell'])->name('investments.sell');
    Route::post('/investments/{acc_number}/buy/{symbol}', [InvestmentController::class, 'buy'])->name('investments.buy');
    Route::get('/investments/{acc_number}', [InvestmentController::class, 'show'])->name('investments');
});

Route::get('/test-redis-counter', function () {
    $counter = Redis::incr('counter_key');
    return "Counter value: $counter";
});

require __DIR__ . '/auth.php';

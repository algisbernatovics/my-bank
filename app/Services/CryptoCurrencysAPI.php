<?php

namespace App\Services;

use App\Models\Accounts;
use GuzzleHttp\Client;

class CryptoCurrencysAPI
{
    protected array $response;
    protected Accounts $investmentAccount;

    public function __construct(Accounts $investmentAccount)
    {
        $this->investmentAccount = $investmentAccount;

        $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
        $parameters = [
            'start' => '1',
            'limit' => $_ENV['CRYPTO_API_LIMIT'],
            'convert' => "$investmentAccount->currency"
        ];

        $headers = [
            'headers' => [
                'Accept' => 'application/json',
                'X-CMC_PRO_API_KEY' => $_ENV['X_CMC_PRO_API_KEY']
            ]
        ];

        $qs = http_build_query($parameters);
        $request = "$url?$qs";

        $client = new Client();
        $response = $client->request('GET', $request, $headers);

        $this->response = json_decode($response->getBody())->data;
    }

    public function getCryptoCurrencys(): array
    {

        foreach ($this->response as $coin) {
            $userInvestments = new AccountInvestments($this->investmentAccount->acc_number, $coin->symbol);
            $cryptoCurrencys[] = Collect([
                'userInvestments' => $userInvestments->getAmount() / 100000,
                'name' => $coin->name,
                'symbol' => $coin->symbol,
                'price' => $coin->quote->{$this->investmentAccount->currency}->price,
            ])->toArray();
        }
        return $cryptoCurrencys;
    }
}

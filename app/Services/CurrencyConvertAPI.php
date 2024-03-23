<?php

namespace App\Services;

use GuzzleHttp\Client;

class CurrencyConvertAPI

{
    protected object $rates;

    public function __construct()
    {
//        $client = new Client();
//        $res = $client->request('GET', 'https://www.latvijasbanka.lv/vk/ecb.xml');
//        $this->rates = (simplexml_load_string($res->getBody()->getContents()))->Currencies;
    }

    public function execute(int $amount, string $toCurrency, string $fromCurrency): int
    {
//        foreach ($this->rates->Currency as $currency) {
//
//            if ($currency->ID == $fromCurrency) {
//                $fromCurrencyRate = (float)$currency->Rate;
//
//            } elseif ($fromCurrency == 'EUR') {
//                $fromCurrencyRate = 1;
//            }
//        }
//
//        {
//            foreach ($this->rates->Currency as $currency) {
//                if ($currency->ID == $toCurrency) {
//                    $toCurrencyRate = (float)$currency->Rate;
//
//                } elseif ($toCurrency == 'EUR') {
//                    $toCurrencyRate = 1;
//                }
//            }
//        }
//        return intval(($amount / $fromCurrencyRate) * $toCurrencyRate);
        return intval($amount);
    }
}


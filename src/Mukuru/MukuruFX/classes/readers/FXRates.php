<?php

/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 5/19/2017
 * Time: 10:18 PM
 */
namespace Mukuru\MukuruFX\classes\readers;

use GuzzleHttp\Client;
use Mukuru\MukuruFX\classes\models\Currency;
use Mukuru\MukuruFX\classes\readers\FXCollection;
use Carbon\Carbon;

class FXRates
{

    /**
     * FXRates constructor.
     */
    public function __construct() {
        return $this->getFXRates();

    }

    protected function getFXRates() {
        //Get Configuration
        //$api_key = config('mukurufxconfig.api_key');
        //Guzzle
        $curr_arr = config('mukurufxconfig.currencies');
        $currencies = new FXCollection($curr_arr);
        $symbols = $currencies->listCurrencies();
        $kesFallBack = config('mukurufxconfig.KES');
        $baseCurrency = config('mukurufxconfig.baseCurrency');
        $endpoint = config('mukurufxconfig.endpoint');
        $client = new Client();
        $response = $client->request('GET', $endpoint, [
            'query' => ['base' => $baseCurrency, 'symbols' => $symbols]
        ]);

        $responcecode = $response->getStatusCode();
        $res_body = (string)$response->getBody();

        if ($responcecode == 200 && !empty($res_body)) {
            $response = json_decode($res_body, true);
        }
        $items = (collect($response));
        $items = $items->pull('rates');
        $now = Carbon::now('utc')->toDateTimeString();

        $this->saveFXRates($items, $now, $kesFallBack, $baseCurrency);
    }

    /**
     * @param $rate
     * @param $now
     * @param $kesFallBack
     * @param $baseCurrency
     */

    protected function saveFXRates($rate, $now, $kesFallBack, $baseCurrency) {
        //dd($rate['USD']);
        $update = new Currency;
        if ($update->where('base_currency', '=', $baseCurrency)->exists()) {

                    $update->where('currency_fx', '=', 'GBP')->update(['base_currency' => $baseCurrency,'currency_fx' => 'GBP', 'exchange_rate' => $rate['GBP']]);
                    $update->where('currency_fx', '=', 'USD')->update(['base_currency' => $baseCurrency,'currency_fx' => 'USD', 'exchange_rate' => $rate['USD']]);
                    $update->where('currency_fx', '=', 'EUR')->update(['base_currency' => $baseCurrency,'currency_fx' => 'EUR', 'exchange_rate' => $rate['EUR']]);
                    $update->where('currency_fx', '=', 'KES')->update(['base_currency' => $baseCurrency,'currency_fx' => 'KES', 'exchange_rate' => $kesFallBack]);

        } else {
            $currency = Currency::insert(
                [
                    ['base_currency' => $baseCurrency,'currency_fx' => 'GBP', 'exchange_rate' => $rate['GBP'], 'created_at' => $now, 'updated_at' => $now],
                    ['base_currency' => $baseCurrency,'currency_fx' => 'USD', 'exchange_rate' => $rate['USD'], 'created_at' => $now, 'updated_at' => $now],
                    ['base_currency' => $baseCurrency,'currency_fx' => 'EUR', 'exchange_rate' => $rate['EUR'], 'created_at' => $now, 'updated_at' => $now],
                    ['base_currency' => $baseCurrency,'currency_fx' => 'KES', 'exchange_rate' => $kesFallBack, 'created_at' => $now, 'updated_at' => $now]
                ]

            );
        }

    }

}
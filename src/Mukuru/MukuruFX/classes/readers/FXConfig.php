<?php
/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 5/19/2017
 * Time: 10:43 PM
 */

return [
    /*
     * Array List of All Currencies we need Live Exchange Rates
     *
     */
    "currencies" => [
        'USD',
        'GBP',
        'EUR',
        'KES'
    ],

    /*
     * Default Currency Fallbacks
     * Used if API does not provide Currency Conversion for the specific currency e.g KES
     */

    "KES" => 7.81498,

    /*
     * The Base Currency We Need to Use to get Live Foreign Exchange Rates
     */

    "baseCurrency" => "ZAR",

    /*
     * The Endpoint or URL of the API Web Service Provider
     */

    "endpoint" => "http://api.fixer.io/latest",

    /*
     * API_KEY :: todo Api_Key :: Encrypt or Key to be saved in DB
     */

    'api_key' => "9bcfb905a16bedb05e41c18eb8a4cedb"


];
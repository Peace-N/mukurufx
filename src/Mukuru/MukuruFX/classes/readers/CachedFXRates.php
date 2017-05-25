<?php
/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 5/22/2017
 * Time: 1:29 PM
 */

namespace Mukuru\MukuruFX\classes\readers;
use Mukuru\MukuruFX\classes\models\Currency;

class CachedFXRates {

    protected $currency;

    public function __construct($currency = []) {
        $this->currency = $currency;
    }

    public function fetFXRatesCached(Currency $currency) {
        return $currency->get();
    }

}
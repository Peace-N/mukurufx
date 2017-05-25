<?php
/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 5/19/2017
 * Time: 10:51 PM
 */

namespace Mukuru\MukuruFX\classes\readers;


class FXCollection {
    /**
     * @var
     */
    protected $currencies;

    /**
     * FXCollection constructor.
     * @param array $currencies
     *
     */
    public function __construct(array $currencies = []) {

        $this->currencies   =  $currencies;

    }

    public function count() {

        return count($this->currencies);

    }

    public function listCurrencies($default = 'USD') {

        return $this->count() > 0 ? implode(',', $this->currencies) : $default;

    }

    public function each(array $items = []) {
        if(is_array($items)) {
            foreach ($items as $item) {
                return $item;
            }
        }
    }
}
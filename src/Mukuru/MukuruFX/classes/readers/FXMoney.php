<?php
/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 5/20/2017
 * Time: 1:34 PM
 */

namespace Mukuru\MukuruFX\classes\readers;


class FXMoney {

    protected $cents;

    public function __construct($cents) {
        $this->cents = (integer) $cents;
    }

    public function fromDecimal() {

    }

    public function toDecimal() {

    }

    public function fromPercent() {

    }

    public function toPercent() {

    }



}
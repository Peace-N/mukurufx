<?php
namespace Mukuru\MukuruFX;
use Mukuru\MukuruFX\classes\readers\FXCollection;
use Mukuru\MukuruFX\classes\readers\FXRates;
use GuzzleHttp\Client;
/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 5/19/2017
 * Time: 5:27 AM
 */
class MukuruFX {
    /**
     * A Cron Command that uses Laravel Scheduling to run a Job
     * @return string
     */
    public static function cron() {
        $client = new FXRates();
        return 'The MukuruFX Rates have been Updated !!';
    }

}
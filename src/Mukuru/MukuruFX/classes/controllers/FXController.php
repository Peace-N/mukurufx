<?php

/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 5/19/2017
 * Time: 9:30 AM
 */
namespace Mukuru\MukuruFX\classes\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mukuru\MukuruFX\classes\models\Currency;
use Mukuru\MukuruFX\classes\readers\CachedFXRates;
use Mukuru\MukuruFX\classes\readers\FXMailer;
use Mukuru\MukuruFX\classes\readers\FXOrders;
use Mukuru\MukuruFX\classes\readers\FXRates;
use Mukuru\MukuruFX\classes\models\Order;

class FXController extends Controller{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        return view('mukurufx::index');

    }

    /**
     * @param FXRates $fxrates
     * @param Currency $currency
     * @param array $default
     * @return array
     *
     */
    public function latestFXRates(CachedFXRates $cachedFXRates, Currency $currency, array $default = []) {

        $data = $cachedFXRates->fetFXRatesCached($currency);
        return $data->isNotEmpty() ? $data->toJson() : $default;

    }

    //Orders API DB::Orders
    public function newOrder(Order $order, Request $request, FXMailer $mailer) {
        //json Response with Amount
        $nowOrder = new FXOrders();
        return $nowOrder->newFxOrder($order, $request, $mailer);
    }

    public function purchaseFX(Request $request) {
        //
    }

}
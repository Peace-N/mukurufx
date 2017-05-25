<?php
/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 5/24/2017
 * Time: 3:24 AM
 */

namespace Mukuru\MukuruFX\classes\readers;
use Illuminate\Http\Request;
use Mukuru\MukuruFX\classes\models\Order;
use Illuminate\Support\Facades\Mail;
class FXOrders
{

    public function newFxOrder(Order $order, Request $request, FXMailer $mailer) {
        $orderItems = $request->all()['order'];
        $data = json_decode($orderItems, true);
        foreach($data as $item) {
            $fx_purchased = $item['fx_purchased'];
            $total_zar_decimal = $item['total_zar_decimal'];
            $fx_exchange_rate = $item['fx_exchange_rate'];
            $surchage_amount = $item['fx_exchange_rate'];
        }

        $this->switchCases($data, $order, $fx_purchased, $total_zar_decimal, $mailer, $fx_exchange_rate, $surchage_amount, $total_zar_decimal);

    }

    public function switchCases($orderItems,
                                Order $order,
                                $fx_purchased,
                                $total_zar,
                                FXMailer $mailer,
                                $fx_exchange_rate,$surchage_amount, $total_zar_decimal) {
        switch ($fx_purchased) {
            case "KES":
                $surcharge = 0.025;
                $this->createOrder($orderItems,$order, $surcharge);
                break;
            case "EUR":
                $surcharge = 0.05;
                $discount = 0.02;
                $this->createOrder($orderItems,$order, $surcharge);
                $this->applyDiscount($order, $discount, $total_zar);
                break;
            case "GBP":
                $surcharge = 0.05;
                $this->createOrder($orderItems,$order, $surcharge);
                $mailer->sendOrderEmail($fx_purchased,$fx_exchange_rate,$surchage_amount,$total_zar_decimal,'peacengara@aol.com');
                break;
            case "USD":
                $surcharge = 0.075;
                $this->createOrder($orderItems,$order, $surcharge);
        }
    }

    public function createOrder($data, Order $order, $surcharge) {

            foreach ($data as $orderItems) {
                $order->currency_id = $orderItems['currency_id'];
                $order->fx_purchased = $orderItems['fx_purchased'];
                $order->fx_exchange_rate = $orderItems['fx_exchange_rate'];
                $order->fx_surcharge = $surcharge;
                $order->fx_purchased_amount = $orderItems['fx_purchased_amount_cents'];
                $order->surcharge_amount = $orderItems['surcharge_amount_cents'];
                $order->surcharge_amount_decimal	 = $orderItems['surcharge_amount_decimal'];
                $order->total_zar = $orderItems['total_zar_cents'];
                $order->total_zar_decimal = $orderItems['total_zar_decimal'];
                $order->save();
        }

    }

    public function applyDiscount(Order $order, $discount, $total_zar_decimal) {
        $discounteAmnt = $total_zar_decimal * $discount;
        $balanceAmnt = ($total_zar_decimal - $discounteAmnt);
        $order->discount()->create([
            'order_dicount' => $discount,
            'discounted_amount' => $discounteAmnt,
            'balance_amount' => $balanceAmnt,

        ]);
    }

}
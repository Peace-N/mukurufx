<?php
/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 5/24/2017
 * Time: 11:50 PM
 */

namespace Mukuru\MukuruFX\classes\readers;
use Illuminate\Support\Facades\Mail;

class FXMailer {
    protected $email_to_address;
    /**
     * @param $fx_purchased
     * @param $fx_exchange_rate
     * @param $surchage_amount
     * @param $total_zar
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendOrderEmail($fx_purchased, $fx_exchange_rate, $surchage_amount, $total_zar, $email_address) {

            $this->email_to_address = $email_address;
        Mail::send('mukurufx::emails.send',
            [
                'title'            => 'Your FX Order Details',
                'fx_purchased'     => $fx_purchased,
                'fx_exchange_rate' => $fx_exchange_rate,
                'surchage_amount'  => $surchage_amount,
                'total_zar'        => $total_zar
            ],
            function ($message)
            {
                $message->from('mukurufx@mukru.com', 'Meagan Foxxx');

                $message->to($this->toEmail($this->email_to_address));

            });

        return response()->json(['message' => 'Order has been Sent']);
    }

    /**
     * @param string $email_address
     * @return string
     */
    public function toEmail($email_address) {
        return $email_address;
    }
}
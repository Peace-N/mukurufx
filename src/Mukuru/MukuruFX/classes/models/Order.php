<?php

/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 5/20/2017
 * Time: 1:44 PM
 */
namespace Mukuru\MukuruFX\classes\models;
use Illuminate\Database\Eloquent\Model;
use Mukuru\MukuruFX\classes\models\Currency;
class Order extends Model {
    protected $table = 'orders';
    protected $fillable = ['fx_purchased', 'fx_exchange_rate','fx_surcharge', 'fx_purchased_amount_cents', 'total_zar_cents', 'surcharge_amount_cents'];

    public function currency() {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function discount() {
        return $this->hasOne(Discount::class, 'order_id', 'id');
    }
}
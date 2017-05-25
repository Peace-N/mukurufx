<?php

/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 5/20/2017
 * Time: 1:44 PM
 */
namespace Mukuru\MukuruFX\classes\models;
use Illuminate\Database\Eloquent\Model;
use Mukuru\MukuruFX\classes\models\Order;
class Currency extends Model {
    protected $table = 'currencies';
    protected $fillable = ['base_currency', 'currency_fx','exchange_rate'];

    public function orders() {
        return $this->hasMany(Order::class, 'currency_id', 'id');
    }
}
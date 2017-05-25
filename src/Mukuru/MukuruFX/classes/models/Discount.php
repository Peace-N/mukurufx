<?php

/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 5/20/2017
 * Time: 1:44 PM
 */
namespace Mukuru\MukuruFX\classes\models;
use Illuminate\Database\Eloquent\Model;
class Discount extends Model {
    protected $table = 'discounts';
    protected $fillable = ['order_dicount', 'discounted_amount','balance_amount'];

    public function discount() {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        //
        Schema::create('orders', function(Blueprint $table) {
            $table->increments('id');
            $table->string('currency_id');
            $table->string('fx_purchased');
            $table->string('fx_exchange_rate');
            $table->string('fx_surcharge');
            $table->string('fx_purchased_amount');
            $table->string('surcharge_amount');
            $table->decimal('surcharge_amount_decimal',13,2);
            $table->string('total_zar');
            $table->decimal('total_zar_decimal',13,2);
            $table->timestamps();

            $table->foreign('currency_id')->references('id')->on('currencies');
        });

        //Schema::enableForeignKeyConstraints();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('orders');
    }
}

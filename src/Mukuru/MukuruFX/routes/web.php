<?php
/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 5/19/2017
 * Time: 11:45 PM
 */


Route::group(['middleware' => ['web'], 'namespace' => 'Mukuru\MukuruFX'], function() {
    // list all Application Routes
    Route::any('/fetchfxrates', ['as' => 'fetchfxrates', 'uses' => 'MukuruFX@cron']);

});

Route::group(['middleware' => ['web'], 'prefix' => '/mukurufx/orders', 'namespace' => 'Mukuru\MukuruFX\classes\controllers'], function () {
        // Order Restful API
        Route::match(['get', 'post'], '/', ['as' => 'mukurufx.orders', 'uses' => 'FXController@index']);
        Route::match(['get', 'post'], '/latestfxrates', ['as' => 'mukurufx.orders.latestfxrates', 'uses' => 'FXController@latestFXRates']);
        Route::match(['get', 'post'], '/new', ['as' => 'mukurufx.orders.new', 'uses' => 'FXController@newOrder']);
});

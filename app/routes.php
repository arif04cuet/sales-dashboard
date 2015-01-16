<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function () {
    return Redirect::to(Config::get('syntara::config.uri'));
});
Route::group(array('before' => 'basicAuth', 'prefix' => Config::get('syntara::config.uri')), function () {
    Route::get('orders/datatable', array('as' => 'orders.datatable', 'uses' => 'OrdersController@datatable'));
    Route::resource('orders', 'OrdersController');

});
Route::get('/test', function()
{
    $a = [1, 2, 3, 4, 5];

    array_pop($a);

    return View::make('home.test');
});
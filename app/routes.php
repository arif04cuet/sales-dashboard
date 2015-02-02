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
    /*//for QCs
    Route::get('qc/datatable', array('as' => 'qc.datatable', 'uses' => 'QcsController@datatable'));
    Route::post('qc', array('as' => 'StoreQc', 'uses' => 'QcsController@store'));
    Route::put('qc/{id}', array('as' => 'UpdateQc', 'uses' => 'QcsController@update'));

    //for Writers
    Route::get('writers/datatable', array('as' => 'writers.datatable', 'uses' => 'WritersController@datatable'));
    Route::post('writers', array('as' => 'StoreWriters', 'uses' => 'WritersController@store'));
    Route::put('writers/{id}', array('as' => 'UpdateWriters', 'uses' => 'WritersController@update'));
    */
    //for Orders
    Route::get('orders/datatable', array('as' => 'orders.datatable', 'uses' => 'OrdersController@datatable'));
    Route::post('orders', array('as' => 'StoreOrders', 'uses' => 'OrdersController@store'));
    Route::put('orders/{id}', array('as' => 'UpdateOrders', 'uses' => 'OrdersController@update'));

    //for Products
    Route::get('products/datatable', array('as' => 'products.datatable', 'uses' => 'ProductsController@datatable'));
    Route::post('products', array('as' => 'StoreProducts', 'uses' => 'ProductsController@store'));
    Route::put('products/{id}', array('as' => 'UpdateProducts', 'uses' => 'ProductsController@update'));

});
Route::group(array('before' => 'basicAuth|hasPermissions', 'prefix' => Config::get('syntara::config.uri')), function () {
    /*//for QCs
    Route::get('qc/', array('as' => 'ListQc', 'uses' => 'QcsController@index'));
    Route::get('qc/create', array('as' => 'CreateQc', 'uses' => 'QcsController@create'));
    Route::get('qc/{id}', array('as' => 'ShowQc', 'uses' => 'QcsController@show'));
    Route::get('qc/{id}/edit', array('as' => 'EditQc', 'uses' => 'QcsController@edit'));
    Route::delete('qc/{id}', array('as' => 'DeleteQc', 'uses' => 'QcsController@destroy'));

    //for Writers
    Route::get('writers/', array('as' => 'ListWriters', 'uses' => 'WritersController@index'));
    Route::get('writers/create', array('as' => 'CreateWriters', 'uses' => 'WritersController@create'));
    Route::get('writers/{id}', array('as' => 'ShowWriters', 'uses' => 'WritersController@show'));
    Route::get('writers/{id}/edit', array('as' => 'EditWriters', 'uses' => 'WritersController@edit'));
    Route::delete('writers/{id}', array('as' => 'DeleteWriters', 'uses' => 'WritersController@destroy'));
    */

    //for Orders
    Route::get('orders/', array('as' => 'ListOrders', 'uses' => 'OrdersController@index'));
    Route::get('orders/create', array('as' => 'CreateOrders', 'uses' => 'OrdersController@create'));
    Route::get('orders/{id}', array('as' => 'ShowOrders', 'uses' => 'OrdersController@show'));
    Route::get('orders/{id}/edit', array('as' => 'EditOrders', 'uses' => 'OrdersController@edit'));
    Route::delete('orders/{id}', array('as' => 'DeleteOrders', 'uses' => 'OrdersController@destroy'));

    //for Products
    Route::get('products/', array('as' => 'ListProducts', 'uses' => 'ProductsController@index'));
    Route::get('products/create', array('as' => 'CreateProducts', 'uses' => 'ProductsController@create'));
    Route::get('products/{id}', array('as' => 'ShowProducts', 'uses' => 'ProductsController@show'));
    Route::get('products/{id}/edit', array('as' => 'EditProducts', 'uses' => 'ProductsController@edit'));
    Route::delete('products/{id}', array('as' => 'DeleteProducts', 'uses' => 'ProductsController@destroy'));
});

Route::get('/test', function () {
    return View::make('home.test');
});
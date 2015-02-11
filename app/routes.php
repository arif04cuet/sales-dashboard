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

    //for Orders
    Route::get('orders/datatable', array('as' => 'orders.datatable', 'uses' => 'OrdersController@datatable'));
    Route::post('orders', array('as' => 'StoreOrders', 'uses' => 'OrdersController@store'));
    Route::put('orders/{id}', array('as' => 'UpdateOrders', 'uses' => 'OrdersController@update'));

    //for Products
    Route::get('products/datatable', array('as' => 'products.datatable', 'uses' => 'ProductsController@datatable'));
    Route::post('products', array('as' => 'StoreProducts', 'uses' => 'ProductsController@store'));
    Route::put('products/{id}', array('as' => 'UpdateProducts', 'uses' => 'ProductsController@update'));

    #getting writer and qc list for order detail page
    Route::get('writerqclist', array('as' => 'writerQcList', 'uses' => 'OrdersController@getWriterQc'));
    Route::post('order/{id}/assign-writer-qc', array('as' => 'assignWriterQc', 'uses' => 'OrdersController@assignWriterQc'));
    Route::post('order/{id}/invitation/{invitaion_id}', array('as' => 'deleteInvitaion', 'uses' => 'OrdersController@deleteInvitaion'));

});
Route::group(array('before' => 'basicAuth|hasPermissions', 'prefix' => Config::get('syntara::config.uri')), function () {

    //for Orders
    Route::get('orders/', array('as' => 'ListOrders', 'uses' => 'OrdersController@index'));
    Route::get('orders/create', array('as' => 'CreateOrders', 'uses' => 'OrdersController@create'));
    Route::get('orders/{id}', array('as' => 'ShowOrders', 'uses' => 'OrdersController@show'));
    Route::get('orders/{id}/edit', array('as' => 'EditOrders', 'uses' => 'OrdersController@edit'));
    Route::delete('orders/{id}', array('as' => 'DeleteOrders', 'uses' => 'OrdersController@destroy'));

    Route::get('orders/{id}/details', array('as' => 'DetailsOrders', 'uses' => 'OrdersController@details'));

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
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
    //for QC
    Route::get('qc/datatable', array('as' => 'qc.datatable', 'uses' => 'QcsController@datatable'));
    Route::post('qc', array('as' => 'StoreQc', 'uses' => 'QcsController@store'));
    Route::put('qc/{id}', array('as' => 'UpdateQc', 'uses' => 'QcsController@update'));
    //for Writer
    Route::get('writers/datatable', array('as' => 'writers.datatable', 'uses' => 'WritersController@datatable'));
    Route::resource('writers', 'WritersController');

    //for Order
    Route::get('orders/datatable', array('as' => 'orders.datatable', 'uses' => 'OrdersController@datatable'));
    Route::resource('orders', 'OrdersController');

});
Route::group(array('before' => 'basicAuth|hasPermissions', 'prefix' => Config::get('syntara::config.uri')), function () {

    //for QC
    Route::get('qc', array('as' => 'listQc', 'uses' => 'QcsController@index'));
    Route::get('qc/create', array('as' => 'CreateQc', 'uses' => 'QcsController@create'));
    Route::get('qc/{id}', array('as' => 'ShowQc', 'uses' => 'QcsController@show'));
    Route::get('qc/{id}/edit', array('as' => 'EditQc', 'uses' => 'QcsController@edit'));
    Route::delete('qc/{id}', array('as' => 'DeleteQc', 'uses' => 'QcsController@destroy'));
});

Route::get('/test', function () {
    return View::make('home.test');
});
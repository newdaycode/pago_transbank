<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('create', 'WebpayPlusController@createdTransaction')->name('create');
Route::get('/webpayplus/returnUrl', 'WebpayPlusController@commitTransaction');

Route::get('/webpayplus/refund', 'WebpayPlusController@showRefund');
Route::post('/webpayplus/refund', 'WebpayPlusController@refundTransaction');

Route::post('/webpayplus/transactionStatus', 'WebpayPlusController@getTransactionStatus');
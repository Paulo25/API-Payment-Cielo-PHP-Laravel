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

Route::group(['prefix' => 'peyer'], function () {
    Route::get('/credit-card', 'CieloController@viewCreditCard')->name('viewCreditCard');
    Route::get('/payment-slip', 'CieloController@viewPaymentSlip')->name('viewPaymentSlip');
    Route::post('/credit-card-push', 'CieloController@peyerCreditCard')->name('peyerCreditCard');
});

Route::get('/', function () {
    return view('welcome');
})->name('pagamento-cielo');

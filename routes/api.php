<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/Payment-Espay','Inquiry\Inquiry@inquiryespay')->name('espay.inquiry');
Route::post('/Payment-Notification','Payment\PaymentController@paymentnotification')->name('payment.notification');

// Route::get('/Data/Espay','Inquiry\InquiryController@getdataespay');
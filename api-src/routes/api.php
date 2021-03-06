<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => ['auth:api']], function () {
    Route::apiResource('family', 'Api\FamilyController');
    Route::apiResource('payee', 'Api\PayeeController');
    Route::apiResource('insurance-company', 'Api\InsuranceCompanyController');
    Route::apiResource('payment', 'Api\PaymentController');
    Route::apiResource('payment', 'Api\PaymentController');
    Route::get('/payment-summary/payee', 'Api\PaymentController@showPayeeSummary');
});

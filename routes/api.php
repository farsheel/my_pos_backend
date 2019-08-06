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


Route::post('login', 'Api\ApiAuthController@login');
Route::post('signup', 'Api\ApiAuthController@signup');

Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::get('logout', 'Api\ApiAuthController@logout');
    Route::get('user', 'Api\ApiAuthController@user');

    Route::get('product', 'Api\ApiProductController@index');
    Route::post('product', 'Api\ApiProductController@create');
    Route::post('product/upload_image', 'Api\ApiProductController@uploadImage');

    Route::get('category', 'Api\ApiCategoryController@index');
    Route::post('category', 'Api\ApiCategoryController@create');

    Route::get('order', 'Api\ApiOrderController@index');
    Route::post('order', 'Api\ApiOrderController@create');
    Route::post('send_email_receipt', 'Api\ApiOrderController@sendEmailReceipt');
});

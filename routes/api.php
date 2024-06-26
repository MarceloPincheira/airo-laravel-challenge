<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('register', 'App\Http\Controllers\AuthController@register');

});

Route::group([
    'middleware' => 'api',
    'prefix' => 'quotation'
], function ($router) {
    Route::post('save', 'App\Http\Controllers\ApiQuotationController@saveQuotation');
    Route::get('all', 'App\Http\Controllers\ApiQuotationController@getAllQuotations');
});
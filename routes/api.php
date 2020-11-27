<?php

use App\Models\Category;
use App\Models\Customer;
use App\Services\Invoice\InvoiceService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
Route::group(['namespace' => 'Api', 'prefix' => 'financial'], function () {

    Route::group(['namespace' => 'Category'], function () {
        Route::apiResource('categories', 'InvoiceCategoryController');
    });

    Route::group(['namespace' => 'Customer', 'prefix' => 'customer'], function () {
        Route::apiResource('providers', 'ProviderController');
        Route::apiResource('clients', 'ClientController');
    });

    Route::group(['namespace' => 'Invoice', 'prefix' => 'invoice'], function () {
        Route::apiResource('receivables', 'ReceivableController');
        Route::apiResource('payables', 'PayableController');
    });

    Route::group(['namespace' => 'Transaction', 'prefix' => 'transaction'], function () {
        Route::apiResource('invoices', 'InvoiceController');
    });
});

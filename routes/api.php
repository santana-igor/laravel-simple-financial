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
        Route::get('categories', function () {
            return Category::all();
        });
    });
    Route::group(['namespace' => 'Customer'], function () {
        Route::get('customers', function () {
            return Customer::all();
        });
        Route::post('customers', function () {
            // DB::table('customers')->insert(
            //     ['name' => 'Embasa', 'document' => null, 'document_number' => null]
            // );
        });
    });
    Route::group(['namespace' => 'Invoice', 'prefix' => 'invoice'], function () {
        Route::apiResource('receivable', 'ReceivableController');
        Route::apiResource('payable', 'PayableController');
    });
});

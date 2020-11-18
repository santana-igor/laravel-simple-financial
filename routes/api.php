<?php

use App\Services\Invoice\InvoiceService;
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

Route::post('/teste', function() {
    $now = new DateTime("now");
    $invoice_service = new InvoiceService(false, 'receivement', 'agua', 20000, 'nenhuma descrição', 1, 1, $now, $now);

    return $invoice_service->pay(1);
});

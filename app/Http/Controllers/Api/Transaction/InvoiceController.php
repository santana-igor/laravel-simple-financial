<?php

namespace App\Http\Controllers\Api\Transaction;

use App\Helpers\NotificationService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\InvoiceRequest;
use App\Services\Invoice\PayableService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceRequest $request, PayableService $payableService)
    {
        // Composição da classe Notification para uso em qualquer parte desse método
            $notification = new NotificationService();

        switch ($request->operation_type) {
            case 'transfer':
                break;
            case 'payment':
                    return $payableService->pay($request->all());
                break;
            case 'receivement':
                break;
            default:
                return $notification->create('error', ['Tipo de operação inexistente. Verifique os tipos permitidos e tente novamente.'], 422);
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

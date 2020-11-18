<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Invoice\InvoiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    public function index(){}

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $rules = [
            'type' => 'in:"receivement","payment"',
            'amount' => 'integer',
            'customer_id' => 'integer',
            'category_id' => 'integer',
            'issued_at' => 'date_format:"Y-m-d H:i:s"',
            'expired_at' => 'date_format:"Y-m-d H:i:s"'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $invoice = new InvoiceService(
            $request->type,
            $request->amount,
            $request->customer_id,
            $request->category_id,
            new Carbon($request->issued_at),
            new Carbon($request->expired_at),
            $request->nickname,
            $request->description,
        );

        if ($invoice->store()) {
            return Response()->json($invoice, 200);
        }
        return Response()->json('ocorreu erro', 500);


    }

    public function update(){}
    public function destroy(){}
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Invoice\Receivement;
use Illuminate\Http\Request;
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

        $receivement = new Receivement($request);

        try {
            $receivement->save();
            return Response()->json($receivement, 200);
        } catch (\Exception $e) {
            return Response()->json($e->getMessage(), 500);
        }
    }

    public function update(){}
    public function destroy(){}
}

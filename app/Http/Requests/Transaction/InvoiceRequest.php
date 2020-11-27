<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "operation_type" => "required|in:payable,receivable",
            "amount" => "required",
            "invoice_id" => "required|exists:invoices,id",
            "bank_account_id" => "required|exists:bank_accounts,id",
            "traded_at" => "required"
        ];
    }
}

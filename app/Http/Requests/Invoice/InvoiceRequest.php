<?php

namespace App\Http\Requests\Invoice;

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
            'type' => 'required|in:payable,receivable',
            'amount' => 'required',
            'customer_id' => 'required|exists:customers,id',
            'category_id' => 'required|exists:categories,id',
            'issued_at' => 'required',
            'expired_at' => 'required'
        ];
    }
}

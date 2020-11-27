<?php

namespace App\Http\Requests\Bank;

use Illuminate\Foundation\Http\FormRequest;

class BankAccountRequest extends FormRequest
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
            "bank_name" => "required",
            "branch" => "required",
            "account" => "required|unique:bank_accounts,account",
            "operation" => "required|in:current,savings",
            "balance" => "required",
        ];
    }
}

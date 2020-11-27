<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class ProviderRequest extends FormRequest
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
            'type' => 'required|in:provider',
            'name' => 'required',
            'document' => 'in:cpf,cnpj|nullable',
            'document_number' => 'required_if:document,cnpj,cpf|unique:customers,document_number',
        ];
    }
}

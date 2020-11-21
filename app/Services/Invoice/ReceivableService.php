<?php

namespace App\Services\Invoice;

use App\Abstracts\MasterClassInvoice;
use Illuminate\Support\Facades\Validator;

class ReceivableService extends MasterClassInvoice
{
    public function store($data)
    {
        $rules = [
            'type' => 'required',
            'amount' => 'required',
            'customer_id' => 'required',
            'category_id' => 'required',
            'issued_at' => 'required',
            'expired_at' => 'required'
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            $notification = [
                'type' => 'error',
                'message' => $validator->getMessageBag()->all(),
                'data' => null
            ];

            return $notification;
        }

        try {
            $this->model->checked = false;
            $this->model->type = 'receivable';
            $this->model->nickname = $data['nickname'];
            $this->model->reference_number = $data['reference_number'];
            $this->model->amount = $data['amount'];
            $this->model->description = $data['description'];
            $this->model->customer_id = $data['customer_id'];
            $this->model->category_id = $data['category_id'];
            $this->model->issued_at = $data['issued_at'];
            $this->model->expired_at = $data['expired_at'];
            $this->model->save();

            $notification = [
                'type' => 'success',
                'message' => ['Cadastro efetuado com sucesso'],
                'data' => $this->model
            ];

            return $notification;
        } catch (\Exception $e) {
            $notification = [
                'type' => 'error',
                'message' => $e->getMessage(),
                'data' => null
            ];

            return $notification;
        }
    }

    public function update(){}
    public function destroy(){}
}

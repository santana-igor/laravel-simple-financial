<?php

namespace App\Services\Invoice;

use App\Abstracts\MasterClassInvoice;
use App\Helpers\NotificationService;
use Illuminate\Support\Facades\Validator;

class PayableService extends MasterClassInvoice
{
    public function store($data)
    {
        // Composição da classe Notification para uso em qualquer parte desse método
        $notification = new NotificationService();

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
            return $notification->create('error', $validator->getMessageBag()->all(), 400);
        }

        try {
            // Criando nova conta a pagar
            $this->model->checked = false;
            $this->model->type = 'payable';
            $this->model->nickname = $data['nickname'];
            $this->model->reference_number = $data['reference_number'];
            $this->model->amount = $data['amount'];
            $this->model->description = $data['description'];
            $this->model->customer_id = $data['customer_id'];
            $this->model->category_id = $data['category_id'];
            $this->model->issued_at = $data['issued_at'];
            $this->model->expired_at = $data['expired_at'];
            $this->model->save();

            return $notification->create('success', ['Cadastro efetuado com sucesso'], 200, $this->model);

        } catch (\Exception $e) {
            return $notification->create('error', [$e->getMessage()], 500);
        }
    }

    public function update(){}
    public function destroy(){}
}

<?php

namespace App\Services\Customer;

use App\Abstracts\MasterClassCustomer;
use App\Helpers\NotificationService;
use Illuminate\Support\Facades\Validator;

class ClientService extends MasterClassCustomer
{
    public function store($data)
    {
        $rules = [
            'type' => 'required|in:client',
            'name' => 'required',
            'document' => 'in:cpf,cnpj|nullable',
            'document_number' => 'required_if:document,cnpj,cpf|unique:customers,document_number',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            $notification = new NotificationService();
            $notification->type('error');
            $notification->message($validator->getMessageBag()->all());
            $notification->statusCode(400);
            return $notification->create();
        }

        try {
            // Criando novo fornecedor
            $this->model->type = $data['type'];
            $this->model->name = $data['name'];
            $this->model->document = $data['document'] ?? null;
            $this->model->document_number = $data['document_number'] ?? null;
            $this->model->save();

            $notification = new NotificationService();
            $notification->type('success');
            $notification->message(['Cadastro efetuado com sucesso']);
            $notification->data($this->model);
            $notification->statusCode(200);

            return $notification->create();
        } catch (\Exception $e) {
            $notification = new NotificationService();
            $notification->type('error');
            $notification->message([$e->getMessage()]);
            $notification->statusCode(500);
            return $notification->create();
        }
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}

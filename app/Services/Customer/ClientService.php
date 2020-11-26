<?php

namespace App\Services\Customer;

use App\Abstracts\MasterClassCustomer;
use App\Helpers\NotificationService;
use Illuminate\Support\Facades\Validator;

class ClientService extends MasterClassCustomer
{
    public function store($data)
    {
        // Composição da classe Notification para uso em qualquer parte desse método
        $notification = new NotificationService();

        $rules = [
            'type' => 'required|in:client',
            'name' => 'required',
            'document' => 'in:cpf,cnpj|nullable',
            'document_number' => 'required_if:document,cnpj,cpf|unique:customers,document_number',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return $notification->create('error', $validator->getMessageBag()->all(), 400);
        }

        try {
            // Criando novo cliente
            $this->model->type = $data['type'];
            $this->model->name = $data['name'];
            $this->model->document = $data['document'] ?? null;
            $this->model->document_number = $data['document_number'] ?? null;
            $this->model->save();

            return $notification->create('success', ['Cadastro efetuado com sucesso'], 200, $this->model);
        } catch (\Exception $e) {
            return $notification->create('error', [$e->getMessage()], 500, $this->model);
        }
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}

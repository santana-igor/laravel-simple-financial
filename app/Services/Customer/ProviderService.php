<?php

namespace App\Services\Customer;

use App\Abstracts\MasterClassCustomer;
use App\Helpers\NotificationService;
use Illuminate\Support\Facades\Validator;

class ProviderService extends MasterClassCustomer
{
    public function store($data)
    {
        $rules = [
            'type' => 'required|in:provider',
            'name' => 'required',
            'document' => 'in:cpf,cnpj|nullable',
            'document_number' => 'required_if:document,cnpj,cpf|unique:customers,document_number',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            $notification = new NotificationService();
            return $notification->create('error', $validator->getMessageBag()->all(), 400);
        }

        try {
            // Criando novo fornecedor
            $this->model->type = $data['type'];
            $this->model->name = $data['name'];
            $this->model->document = $data['document'] ?? null;
            $this->model->document_number = $data['document_number'] ?? null;
            $this->model->save();

            $notification = new NotificationService();
            return $notification->create('success', ['Cadastro efetuado com sucesso'], 200, $this->model);
        } catch (\Exception $e) {
            $notification = new NotificationService();
            return $notification->create('error', [$e->getMessage()], 500);
        }
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}

<?php

namespace App\Services\Bank;

use App\Abstracts\MasterClassBankAccount;
use App\Helpers\NotificationService;

class BankAccountService extends MasterClassBankAccount
{
    public function store($data)
    {
        // Composição da classe Notification para uso em qualquer parte desse método
            $notification = new NotificationService();

        try {
            // Criando nova conta bancária
                $this->model->bank_name = $data['bank_name'];
                $this->model->branch = $data['branch'];
                $this->model->account = $data['account'];
                $this->model->operation = $data['operation'];
                $this->model->balance = $data['balance'];
                $this->model->save();

            return $notification->create('success', ['Cadastro efetuado com sucesso'], 200, $this->model);

        } catch (\Exception $e) {
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

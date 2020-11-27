<?php

namespace App\Abstracts;

use App\Models\BankAccount;

abstract class MasterClassBankAccount
{
    protected $model;

    public function __construct(BankAccount $bankAccount)
    {
        $this->model = $bankAccount;
    }

    abstract public function store($data);
    abstract public function update();
    abstract public function destroy();
}

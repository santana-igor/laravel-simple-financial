<?php

namespace App\Abstracts;

use App\Models\Customer;

abstract class MasterClassCustomer
{
    /**
     * @var Customer
     */
    protected $model;

    public function __construct(Customer $customer)
    {
        $this->model = $customer;
    }

    abstract public function store($data);
    abstract public function update();
    abstract public function destroy();
}

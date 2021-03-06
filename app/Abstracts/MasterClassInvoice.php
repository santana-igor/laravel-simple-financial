<?php

namespace App\Abstracts;

use App\Models\Invoice;

abstract class MasterClassInvoice
{
    /**
     * @var Invoice
     */
    protected $model;

    public function __construct(Invoice $invoice)
    {
        $this->model = $invoice;
    }

    abstract public function all();
    abstract public function store($data);
    abstract public function update();
    abstract public function destroy();
}

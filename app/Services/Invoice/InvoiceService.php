<?php

namespace App\Services\Invoice;

use App\Models\Invoice;
use App\Services\Abstracts\InvoiceAbstract;

class InvoiceService extends InvoiceAbstract
{

    /**
     * Em $type é permitido apenas ['receivement', 'payment']
     *
     * @param mixed $type
     * @param mixed $nickname
     * @param mixed $amount
     * @param mixed $description
     * @param mixed $customer_id
     * @param mixed $category_id
     * @param mixed $issued_at
     * @param mixed $expired_at
     */
    public function __construct($type, $amount, $customer_id, $category_id, $issued_at, $expired_at, $nickname, $description)
    {
        parent::__construct($type, $amount, $customer_id, $category_id, $issued_at, $expired_at, $nickname, $description);
    }

    public function store()
    {
        try {
            $invoice = new Invoice();
            $invoice->type = $this->type;
            $invoice->nickname = $this->nickname;
            $invoice->amount = $this->amount;
            $invoice->description = $this->description;
            $invoice->customer_id = $this->customer_id;
            $invoice->category_id = $this->category_id;
            $invoice->issued_at = $this->issued_at;
            $invoice->expired_at = $this->expired_at;
            $invoice->save();

            return true;
        } catch (\Exception $ex) {
            return false;
        }
    }

    public function pay($invoice_id): bool
    {
        $this->id = $invoice_id;

        try {
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }

    public function receive($invoice_id): bool
    {
        $this->id = $invoice_id;
        return true;
    }
}

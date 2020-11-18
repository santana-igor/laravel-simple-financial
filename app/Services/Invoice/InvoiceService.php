<?php

namespace App\Services\Invoice;
use App\Services\Abstracts\InvoiceAbstract;

class InvoiceService extends InvoiceAbstract
{

    /**
     * Em $type é permitido apenas ['receivement', 'payment']
     *
     * @param mixed $checked
     * @param mixed $type
     * @param mixed $nickname
     * @param mixed $amount
     * @param mixed $description
     * @param mixed $customer_id
     * @param mixed $category_id
     * @param mixed $issued_at
     * @param mixed $expired_at
     */
    public function __construct($checked, $type, $nickname, $amount, $description, $customer_id, $category_id, $issued_at, $expired_at)
    {
        parent::__construct($checked, $type, $nickname, $amount, $description, $customer_id, $category_id, $issued_at, $expired_at);
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

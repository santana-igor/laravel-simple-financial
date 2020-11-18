<?php

namespace App\Services\Invoice;

use App\Models\Invoice;
use App\Services\Abstracts\InvoiceAbstract;

class InvoiceService extends InvoiceAbstract
{

    /**
     *
     * @param string $type Permitido apenas ['receivement', 'payment']
     * @param integer $amount Valor da conta
     * @param integer $customer_id ID Fornecedor/Cliente
     * @param integer $category_id ID Categoria da conta, Ex.: Água, Energia
     * @param Carbon $issued_at Data de emissão
     * @param Carbon $expired_at Data de vencimento
     * @param string $nickname Nome/Apelido para conta
     * @param string $description Observação/Descrição
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

<?php

namespace App\Services\Invoice;

use App\Models\Invoice;
use App\Services\Abstracts\InvoiceAbstract;
use Exception;
use Illuminate\Http\Request;

class Receivement extends InvoiceAbstract
{

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function save()
    {
        if ($this->type === 'receivement') {
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
        } else {
            throw new Exception("Você está tentando lançar uma conta diferente do tipo de recebimento", 1);
        }
    }

    public function update()
    {}

    public function delete()
    {}


}

<?php

namespace App\Services\Abstracts;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\Traits\InvoiceTrait;

abstract class InvoiceAbstract
{
    use InvoiceTrait;

    /**
     * @param Request $request
     */
    protected function __construct(Request $request)
    {
        $this->type = $request->type;
        $this->nickname = $request->nickname;
        $this->amount = $request->amount;
        $this->description = $request->description;
        $this->customer_id = $request->customer_id;
        $this->category_id = $request->category_id;
        $this->issued_at = new Carbon($request->issued_at);
        $this->expired_at = new Carbon($request->expired_at);
    }

    abstract public function save();
    abstract public function update();
    abstract public function delete();
}

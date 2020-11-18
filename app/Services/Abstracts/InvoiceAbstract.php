<?php

namespace App\Services\Abstracts;

use Carbon\Carbon;

abstract class InvoiceAbstract
{

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var boolean
     */
    protected $checked;

    /**
     * Permitido apenas ['receivement', 'payment']
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $nickname;

    /**
     * @var string
     */
    protected $reference_number;

    /**
     * @var integer
     */
    protected $amount;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var integer
     */
    protected $customer_id;

    /**
     * @var integer
     */
    protected $category_id;

    /**
     * @var DateTime
     */
    protected $issued_at;

    /**
     * @var DateTime
     */
    protected $expired_at;


    /**
     * @param string $type
     * @param string $nickname
     * @param int $amount
     * @param string $description
     * @param int $customer_id
     * @param int $category_id
     * @param Carbon $issued_at
     * @param Carbon $expired_at
     */
    protected function __construct(string $type, int $amount, int $customer_id, int $category_id, Carbon $issued_at, Carbon $expired_at, string $nickname = null, string $description = null)
    {
        $this->type = $type;
        $this->nickname = $nickname;
        $this->amount = $amount;
        $this->description = $description;
        $this->customer_id = $customer_id;
        $this->category_id = $category_id;
        $this->issued_at = $issued_at;
        $this->expired_at = $expired_at;
    }

    abstract public function store();

    abstract public function pay($invoice_id): bool;

    abstract public function receive($invoice_id): bool;

}

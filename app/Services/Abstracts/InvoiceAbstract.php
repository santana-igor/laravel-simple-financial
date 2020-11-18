<?php

namespace App\Services\Abstracts;

use DateTime;

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
     * @param bool $checked
     * @param string $type
     * @param string $nickname
     * @param int $amount
     * @param string $description
     * @param int $customer_id
     * @param int $category_id
     * @param DateTime $issued_at
     * @param DateTime $expired_at
     */
    protected function __construct(bool $checked, string $type, string $nickname, int $amount, string $description, int $customer_id, int $category_id, DateTime $issued_at, DateTime $expired_at)
    {
        $this->checked = $checked;
        $this->type = $type;
        $this->nickname = $nickname;
        $this->amount = $amount;
        $this->description = $description;
        $this->customer_id = $customer_id;
        $this->category_id = $category_id;
        $this->issued_at = $issued_at;
        $this->expired_at = $expired_at;
    }

    abstract public function pay($invoice_id): bool;

    abstract public function receive($invoice_id): bool;

}

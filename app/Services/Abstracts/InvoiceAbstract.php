<?php

namespace App\Services\Abstracts;

use Carbon\Carbon;
use Illuminate\Http\Request;

abstract class InvoiceAbstract
{

    /**
     * ID da conta
     * @var integer
     */
    protected $id;

    /**
     * Verifica se a conta foi quitada/ dado baixa
     * @var boolean
     */
    protected $checked;

    /**
     * Tipo de conta (A receber/ A pagar) - Permitido apenas ['receivement', 'payment']
     * @var string
     */
    protected $type;

    /**
     * Apelido para conta
     * @var string
     */
    protected $nickname;

    /**
     * Número de referencia da conta
     * @var string
     */
    protected $reference_number;

    /**
     * Valor da conta
     * @var integer
     */
    protected $amount;

    /**
     * Breve descrição da conta
     * @var string
     */
    protected $description;

    /**
     * ID do Cliente/ Fornecedor (Relacionamento)
     * @var integer
     */
    protected $customer_id;

    /**
     * ID da categoria (Relacionamento)
     * @var integer
     */
    protected $category_id;

    /**
     * Data/ Hora de emissão
     * @var Carbon
     */
    protected $issued_at;

    /**
     * Data/ Hora de vencimento
     * @var Carbon
     */
    protected $expired_at;


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

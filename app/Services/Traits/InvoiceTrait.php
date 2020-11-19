<?php

namespace App\Services\Traits;

trait InvoiceTrait
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
    * Get $id
    * @return integer
    */
    public function getId(): int
    {
        return $this->id;
    }

    /**
    * Get $checked
    * @return boolean
    */
    public function getChecked(): bool
    {
        return $this->checked;
    }

    /**
    * Get $type
    * @return string
    */
    public function getType(): string
    {
        return $this->type;
    }

    /**
    * Get $nickname
    * @return string
    */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
    * Get $amount
    * @return integer
    */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
    * Get $description
    * @return string
    */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
    * Set $id
    * @param integer $id
    */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
    * Set $checked
    * @param boolean $checked
    */
    public function setChecked(bool $checked)
    {
        $this->checked = $checked;
    }

    /**
    * Set $type
    * @param string $type
    */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
    * Set $nickname
    * @param string $nickname
    */
    public function setNickname(string $nickname)
    {
        $this->nickname = $nickname;
    }

    /**
    * Set $amount
    * @param integer $amount
    */
    public function setAmount(int $amount)
    {
        $this->amount = $amount;
    }

    /**
    * Set $description
    * @param string $description
    */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

}

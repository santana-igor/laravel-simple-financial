<?php

namespace App\Helpers;

use App\Contracts\NotificationInterface;

class NotificationService implements NotificationInterface
{
    private string $type;
    private array $messages;
    private $data;

    final function __construct() {}
    final function __clone() {}

    /**
     * Tipo de notificação ['error', 'success']
     * @param array $type
     *
     * @return void
     */
    public function type(string $type): void
    {
        $this->type = $type;
    }

    /**
     * Mensagens de tratamento de erro
     * @param array $messages
     *
     * @return void
     */
    public function message(array $messages): void
    {
        $this->messages = $messages;
    }

    /**
     * Dados a mais que deseja inserir dentro da notificação
     * @param mixed $data
     *
     * @return void
     */
    public function data($data = null): void
    {
        $this->data = $data;
    }

    public function create()
    {
        return [
            'type' => $this->type,
            'messages' => $this->messages,
            'data' => $this->data
        ];
    }
}

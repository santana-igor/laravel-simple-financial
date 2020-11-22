<?php

namespace App\Helpers;

use App\Contracts\NotificationInterface;

class NotificationService implements NotificationInterface
{
    private string $type;
    private array $messages;
    private int $status_code;
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

    /**
     * Status Code da resposta:
     * 200 - Requisição bem sucedida
     * 400 - Requisição mal sucedida. Servidor não entendeu a requisição; Falha na validação; Sintaxe inválida
     * 401 - Cliente deve se autenticar para obter a resposta solicitada.
     * 404 - O servidor não pode encontrar o recurso solicitado
     * 500 - O servidor encontrou uma situação com a qual não sabe lidar
     *
     * @param int $status_code
     *
     * @return void
     */
    public function statusCode(int $status_code): void
    {
        $this->status_code = $status_code;
    }

    public function create()
    {
        return [
            'status_code' => $this->status_code ?? 200,
            'type' => $this->type,
            'messages' => $this->messages,
            'data' => $this->data
        ];
    }
}

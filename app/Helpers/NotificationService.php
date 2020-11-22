<?php

namespace App\Helpers;

use App\Contracts\NotificationInterface;

class NotificationService
{
    private const ERROR_TYPES = [
        "success",
        "error",
        "warning"
    ];

    /**
     * Status Code da resposta:
     * 200 - Requisição bem sucedida
     * 400 - Requisição mal sucedida. Servidor não entendeu a requisição; Falha na validação; Sintaxe inválida
     * 401 - Cliente deve se autenticar para obter a resposta solicitada.
     * 404 - O servidor não pode encontrar o recurso solicitado
     * 500 - O servidor encontrou uma situação com a qual não sabe lidar
     */
    private const STATUS_CODES = [
        200,
        400,
        401,
        404,
        500
    ];

    private static $error_type;
    private static $status_code;
    private static $messages;
    private static $data;

    final function __construct() {}
    final function __clone() {}

    public function create(string $error_type, array $messages, int $status_code = null, $data = null)
    {
        $this->setStatusCode($status_code);
        $this->setErrorType($error_type);
        $this->setMessages($messages);
        $this->setData($data);

        return [
            'status_code' => self::$status_code ?? 200,
            'type' => self::$error_type,
            'messages' => self::$messages,
            'data' => self::$data
        ];
    }

    /**
     * Set $error_type
     * @param string $error_type
     */
    private function setErrorType(string $error_type): void
    {
        if (in_array($error_type, self::ERROR_TYPES)) {
            self::$error_type = $error_type;
        } else {
            self::$error_type = "Undefined";
        }
    }

    /**
     * Set $status_code
     * @param int $status_code
     */
    private function setStatusCode(int $status_code): void
    {
        if (!empty($status_code)) {
            self::$status_code = $status_code;
        } else {
            self::$status_code = 200;
        }
    }

    /**
    * Set $messages
    * @param array $messages
    */
    private function setMessages(array $messages): void
    {
        if (!empty($messages)) {
            self::$messages = $messages;
        } else {
            self::$messages = [];
        }
    }

    /**
    * Set $data
    * @param $data
    */
    private function setData($data): void
    {
        if (!empty($data)) {
            self::$data = $data;
        } else {
            self::$data = null;
        }
    }

}

<?php

namespace App\Contracts;

interface NotificationInterface
{
    public function type(string $type);
    public function message(array $messages);
    public function data($data = null);
    public function create();
}

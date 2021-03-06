<?php

namespace App\Utils\UseCases\Registration\Command\ConfirmToken;

final class Command
{
    public function __construct(
        private string $token
    )
    {
    }

    public function getToken(): string
    {
        return $this->token;
    }
}

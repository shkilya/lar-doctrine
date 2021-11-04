<?php
declare(strict_types=1);
namespace App\Utils\UseCases\Registration\Command\RequestForRegistration;

final class Command
{
    public function __construct(
        public string $email,
        public string $password
    )
    {
    }
}

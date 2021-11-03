<?php
declare(strict_types=1);

namespace App\Utils\UseCases\Registration;

class Command
{
    public function __construct(
        public string $email,
        public string $password
    )
    {

    }


}

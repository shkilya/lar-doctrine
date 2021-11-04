<?php
declare(strict_types=1);

namespace App\Utils\UseCases\Role\Command\Create;

final class Command
{
    public function __construct(
        private string $name
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }
}

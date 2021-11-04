<?php
declare(strict_types=1);

namespace App\Utils\UseCases\Role\Query\GetRoleByUser;

final class Query
{
    public function __construct(
        private string $userId
    )
    {
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

}

<?php
declare(strict_types=1);

namespace App\Utils\UseCases\Role\Query\GetRoleByUser;

final class Fetcher
{

    public function __construct()
    {
    }

    public function fetch(Query $query)
    {
        $query->getUserId();
    }
}

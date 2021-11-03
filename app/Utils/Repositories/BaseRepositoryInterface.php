<?php
declare(strict_types=1);

namespace App\Utils\Repositories;

use App\ValueObjects\Common\Id;

interface BaseRepositoryInterface
{
    public function getById(Id $id);
}

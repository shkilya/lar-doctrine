<?php
declare(strict_types=1);

namespace App\Utils\Repositories;

use App\ValueObjects\Common\Email;

interface UserRepositoryInterface
{
    public function isUserExistByEmail(Email $email): bool;
}

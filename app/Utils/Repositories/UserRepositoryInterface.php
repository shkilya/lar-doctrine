<?php
declare(strict_types=1);

namespace App\Utils\Repositories;

use App\Entities\User;
use App\ValueObjects\Common\Email;

interface UserRepositoryInterface
{
    public function isUserExistByEmail(Email $email): bool;

    public function findByJoinConfirmToken(string $token): ?User;
}

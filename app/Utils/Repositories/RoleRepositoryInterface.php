<?php
declare(strict_types=1);

namespace App\Utils\Repositories;

use App\Entities\Role;

interface RoleRepositoryInterface
{
    public function getRoleUser():Role;

    public function isRoleExist(string $role):bool;
}

<?php
declare(strict_types=1);

namespace App\Utils\Repositories;

use App\Entities\Role;

interface RoleRepositoryInterface
{
    /**
     * @return Role
     */
    public function getRoleUser():Role;
}

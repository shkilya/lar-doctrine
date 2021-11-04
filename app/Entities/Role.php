<?php
declare(strict_types=1);

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use LaravelDoctrine\ACL\Contracts\Role as RoleContract;
use LaravelDoctrine\ACL\Permissions\HasPermissions;

/**
 * @ORM\Entity
 */
final class Role implements RoleContract
{
    public const ROLE_USER = 'ROLE_USER';
    public const ROLE_SUPERADMIN = 'ROLE_SUPERADMIN';
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_MANAGER = 'ROLE_MANAGER';

    public const ROLE_LIST = [
        Role::ROLE_USER,
        Role::ROLE_ADMIN,
        Role::ROLE_MANAGER,
        Role::ROLE_SUPERADMIN,
    ];

    use HasPermissions;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;


    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="\App\Entities\Permission", mappedBy="permission")
     * @ORM\JoinTable(name="role_permissions")
     */
    private Collection $permissions;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->permissions = new ArrayCollection();

    }


    public function getPermissions(): Collection
    {
        return $this->permissions;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function createUserRole(): Role
    {
        return new Role(self::ROLE_USER);
    }
}

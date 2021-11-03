<?php
declare(strict_types=1);

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use LaravelDoctrine\ACL\Contracts\Role as RoleContract;
use LaravelDoctrine\ACL\Permissions\HasPermissions;
use LaravelDoctrine\ACL\Permissions\Permission;

/**
 * @ORM\Entity
 */
final class Role implements RoleContract
{
    private const ROLE_USER = 'ROLE_USER';

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

    public function __construct()
    {
        $this->permissions  = new ArrayCollection();
    }


    public function getPermissions():Collection
    {
        return $this->permissions;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

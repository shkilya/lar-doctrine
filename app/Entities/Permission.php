<?php
declare(strict_types=1);

namespace App\Entities;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use LaravelDoctrine\ACL\Contracts\Permission as PermissionContract;

/**
 * @ORM\Entity
 */
class Permission implements PermissionContract
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="Role")
     */
    private Collection $roles;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Permission
     */
    public function setName(string $name): Permission
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param Collection $roles
     * @return Permission
     */
    public function setRoles(Collection $roles): Permission
    {
        $this->roles = $roles;
        return $this;
    }


    /**
     * @return Collection
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

}

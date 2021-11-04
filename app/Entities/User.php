<?php
declare(strict_types=1);

namespace App\Entities;

use App\ValueObjects\Common\Email;
use App\ValueObjects\User\Status;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DomainException;
use LaravelDoctrine\ACL\Permissions\HasPermissions;
use LaravelDoctrine\ACL\Roles\HasRoles;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="auth_users")
 */
final class User
{
    use HasRoles, HasPermissions;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string")
     */
    private Email $email;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $passwordHash = null;

    /**
     * @ORM\ManyToMany(targetEntity="Role", mappedBy="user", cascade={"persist"})
     */
    private ?Collection $roles = null;

    /**
     * @var Status
     * @ORM\Column(type="user_status")
     */
    private Status $status;

    /**
     * @var Token|null
     * @ORM\Embedded(class="Token")
     */
    private ?Token $registrationToken = null;

    /**
     * @var \DateTimeImmutable
     * @ORM\Column(type="date_immutable")
     */
    private \DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }

    public static function registerByEmail(
        Email  $email,
        string $passwordHash,
        Role   $role,
        ?Token $token
    ): self
    {
        $self = new self();
        $self->email = $email;
        $self->passwordHash = $passwordHash;
        $self->status = Status::pending();
        $self->roles->add($role);
        $self->registrationToken = $token;
        return $self;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getPasswordHash(): ?string
    {
        return $this->passwordHash;
    }

    /**
     * @return Collection|Role[]
     */
    public function getRoles(): array|Collection
    {
        return $this->roles;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * @return Token|null
     */
    public function getRegistrationToken(): ?Token
    {
        return $this->registrationToken;
    }

    public function confirmVerification(string $token, DateTimeImmutable $date):void
    {
        if ($this->registrationToken === null) {
            throw new DomainException('Confirmation is not required.');
        }
        $this->registrationToken->validate($token, $date);
        $this->status = Status::active();
        $this->registrationToken = null;
    }

}

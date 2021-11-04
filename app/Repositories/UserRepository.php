<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\User;
use App\Utils\Repositories\UserRepositoryInterface;
use App\ValueObjects\Common\Email;
use Doctrine\ORM\EntityManagerInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, User::class);
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function isUserExistByEmail(Email $email): bool
    {
        return $this->createQueryBuilder('t')
                ->select('COUNT(t.id)')
                ->andWhere('t.email = :email')
                ->setParameter(':email', $email->getValue())
                ->getQuery()->getSingleScalarResult() > 0;
    }

    public function findByJoinConfirmToken(string $token): ?User
    {
        return $this->findOneBy(['registrationToken.token' => $token]);
    }
}

<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Role;
use App\Utils\Repositories\RoleRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, Role::class);
    }

    /**
     * @param string $role
     * @return bool
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function isRoleExist(string $role):bool
    {
        return $this->createQueryBuilder('t')
                ->select('COUNT(t.id)')
                ->andWhere('name = :role')
                ->setParameter(':role', $role)
                ->getQuery()
                ->getSingleScalarResult() > 0;
    }


    public function getRoleUser(): Role
    {
        $result = $this->findOneBy(['name' => Role::ROLE_USER]);
        if ($result === null) {
            throw new \DomainException('Role was not found');
        }
        return $result;
    }
}

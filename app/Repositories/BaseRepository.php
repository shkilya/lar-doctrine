<?php
declare(strict_types=1);

namespace App\Repositories;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;

abstract class BaseRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em,string $class)
    {
        parent::__construct($em,new Mapping\ClassMetadata($class));
    }
}

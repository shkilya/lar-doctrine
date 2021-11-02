<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Scientist;
use App\ValueObjects\Common\Id;
use Doctrine\ORM\EntityManagerInterface;

final class ScientistRepository extends BaseRepository
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, Scientist::class);
    }

    public function getById(Id $id): Scientist
    {
        $scientist = $this->find($id->getValue());
        if ($scientist == null) {
            throw new \DomainException('Not found');
        }
        return $scientist;
    }
}

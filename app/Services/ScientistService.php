<?php
declare(strict_types=1);

namespace App\Services;

use App\Entities\Scientist;
use App\Repositories\ScientistRepository;
use App\ValueObjects\Common\Id;

final class ScientistService
{
    public function __construct(
        private ScientistRepository $scientistRepository
    )
    {
    }

    public function getById(Id $id): Scientist
    {
        return $this->scientistRepository->getById($id);
    }
}


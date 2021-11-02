<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Entities\Scientist;
use App\Entities\Theory;
use App\Repositories\ScientistRepository;
use App\Services\ScientistService;
use App\ValueObjects\Common\Id;
use Doctrine\ORM\EntityManagerInterface;

class HomeController
{
    public function __construct(
        private ScientistService $scientistService
    )
    {

    }

    public function index(): Scientist
    {
        return $this->scientistService->getById(new Id(1));
    }
}

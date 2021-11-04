<?php
declare(strict_types=1);

namespace App\Utils\UseCases\Role\Command\Create;

use App\Entities\Role;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

final class Handler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private LoggerInterface        $logger,
    )
    {
    }

    public function handle(Command $command)
    {
        try {
            $this->entityManager->persist(
                new Role($command->getName())
            );
            $this->entityManager->flush();
        } catch (\Exception $exception) {
            $this->logger->error('', [
                'message' => $exception->getMessage()
            ]);
            throw $exception;
        }

    }
}

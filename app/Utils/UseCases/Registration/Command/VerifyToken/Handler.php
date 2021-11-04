<?php
declare(strict_types=1);

namespace App\Utils\UseCases\Registration\Command\VerifyToken;

use App\Utils\Repositories\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

final class Handler
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function handle(Command $command): void
    {
        $user = $this->userRepository->findByJoinConfirmToken($command->getToken());
        if ($user == null) {
            throw new \DomainException('Incorrect token');
        }
        $user->confirmVerification($command->getToken(), new \DateTimeImmutable());
        $this->entityManager->flush();
    }
}

<?php
declare(strict_types=1);

namespace App\Utils\UseCases\Registration\Command\RequestForRegistration;

use App\Entities\User;
use App\Utils\Repositories\RoleRepositoryInterface;
use App\Utils\Repositories\UserRepositoryInterface;
use App\Utils\Services\TokenGenerator;
use App\Utils\Services\VerificationEmailSender;
use App\ValueObjects\Common\Email;
use Doctrine\ORM\EntityManagerInterface;
use DomainException;
use Illuminate\Contracts\Hashing\Hasher;

final class Handler
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private Hasher                  $passwordHasher,
        private EntityManagerInterface  $entityManager,
        private RoleRepositoryInterface $roleRepository,
        private TokenGenerator          $tokenGenerator,
        private VerificationEmailSender $verificationEmailSender
    )
    {
    }

    public function handle(Command $command): void
    {
        $email = new Email($command->email);
        if ($this->userRepository->isUserExistByEmail($email)) {
            throw new DomainException('User already exists.');
        }

        $date = new \DateTimeImmutable();
        $token = $this->tokenGenerator->generate($date);
        $user = User::registerByEmail(
            email: $email,
            passwordHash: $this->passwordHasher->make($command->password),
            role: $this->roleRepository->getRoleUser(),
            token: $token
        );

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}

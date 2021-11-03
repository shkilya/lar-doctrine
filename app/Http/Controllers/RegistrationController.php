<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Utils\UseCases\Registration\Command;
use App\Utils\UseCases\Registration\Handler as RegistrationHandler;
use Exception;
use Psr\Log\LoggerInterface;

class RegistrationController
{
    public function __construct(
        private RegistrationHandler $registrationHandler,
        private LoggerInterface     $logger
    )
    {

    }

    public function __invoke(RegistrationRequest $request)
    {
        try {
            $this->registrationHandler->handle(
                new Command(
                    email: $request->getEmail(),
                    password: $request->getPassword()
                )
            );
            return [];
        } catch (Exception $exception) {
            $this->logger->error('Registration Error', [
                'message' => $exception->getMessage()
            ]);
            throw $exception;
        }

    }
}

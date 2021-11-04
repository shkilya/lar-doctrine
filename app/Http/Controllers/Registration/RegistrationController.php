<?php
declare(strict_types=1);

namespace App\Http\Controllers\Registration;

use App\Http\Requests\RegistrationRequest;
use App\Utils\UseCases\Registration\Command\RequestForRegistration\Handler as RegistrationHandler;
use App\Utils\UseCases\Registration\Command\RequestForRegistration\Command as RegistrationCommand;
use Exception;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('/api/v1'),Middleware('api')]
class RegistrationController
{
    public function __construct(
        private RegistrationHandler $registrationHandler,
        private LoggerInterface     $logger
    )
    {
    }

    #[Post('registration',name: "registration")]
    public function index(RegistrationRequest $request)
    {
        try {
            $this->registrationHandler->handle(
                new RegistrationCommand(
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

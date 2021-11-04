<?php
declare(strict_types=1);

namespace App\Http\Controllers\Registration;

use App\Utils\UseCases\Registration\Command\VerifyToken\Command as VerifyTokenCommand;
use App\Utils\UseCases\Registration\Command\VerifyToken\Handler as VerifyTokenHandler;
use Psr\Log\LoggerInterface;
use Spatie\RouteAttributes\Attributes\Get;

final class VerificationController
{
    public function __construct(
        private VerifyTokenHandler $verifyTokenHandler,
        private LoggerInterface    $logger
    )
    {
    }

    /**
     * @throws \Exception
     */
    #[Get('verify-token/{token}')]
    public function __invoke(string $token): void
    {
        try {
            $this->verifyTokenHandler->handle(new VerifyTokenCommand($token));
        } catch (\Exception $exception) {
            $this->logger->critical('', [
                'message' => $exception->getMessage()
            ]);
            throw $exception;
        }
    }
}

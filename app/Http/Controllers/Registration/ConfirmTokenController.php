<?php
declare(strict_types=1);

namespace App\Http\Controllers\Registration;

use App\Utils\UseCases\Registration\Command\ConfirmToken\Command as ConfirmTokenCommand;
use App\Utils\UseCases\Registration\Command\ConfirmToken\Handler as ConfirmTokenHandler;
use Psr\Log\LoggerInterface;
use Spatie\RouteAttributes\Attributes\Get;

final class ConfirmTokenController
{
    public function __construct(
        private ConfirmTokenHandler $verifyTokenHandler,
        private LoggerInterface     $logger
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
            $this->verifyTokenHandler->handle(new ConfirmTokenCommand($token));
        } catch (\Exception $exception) {
            $this->logger->critical('', [
                'message' => $exception->getMessage()
            ]);
            throw $exception;
        }
    }
}

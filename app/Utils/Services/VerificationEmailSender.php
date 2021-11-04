<?php
declare(strict_types=1);

namespace App\Utils\Services;

use App\Entities\Token;
use App\Mail\RegistrationVerificationEmail;
use App\ValueObjects\Common\Email;
use Illuminate\Contracts\Mail\Mailer;

class VerificationEmailSender
{
    public function __construct(
        private Mailer $mailer
    )
    {

    }

    public function send(Email $email, Token $token): void
    {
        $this->mailer
            ->to($email->getValue())
            ->send(new RegistrationVerificationEmail(
                email: $email->getValue(),
                token: $token
            ));

    }
}

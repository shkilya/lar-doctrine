<?php

namespace App\Mail;

use App\Entities\Token;
use App\ValueObjects\Common\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationVerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        private string $email,
        private Token  $token,
    )
    {
    }

    public function build(): static
    {
        return $this->view('mails.registration-verification-email', [
            'token' => $this->token,
            'email' => $this->email
        ]);
    }
}

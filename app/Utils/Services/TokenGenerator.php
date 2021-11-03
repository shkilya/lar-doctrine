<?php
declare(strict_types=1);

namespace App\Utils\Services;

use App\Entities\Token;
use DateInterval;
use Ramsey\Uuid\Uuid;

final class TokenGenerator
{
    private DateInterval $interval;

    public function __construct(DateInterval $interval)
    {
        $this->interval = $interval;
    }

    public function generate(\DateTimeImmutable $date): Token
    {
        return new Token(
            value: Uuid::uuid4()->toString(),
            expires: $date->add($this->interval)
        );
    }
}

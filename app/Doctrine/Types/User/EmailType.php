<?php
declare(strict_types=1);

namespace App\Doctrine\Types\User;

use App\ValueObjects\Common\Email;
use App\ValueObjects\User\Status;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class EmailType extends StringType
{
    public const NAME = 'email';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Email ? $value->getValue() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !empty($value) ? new Email((string)$value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}

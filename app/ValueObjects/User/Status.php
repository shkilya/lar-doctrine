<?php
declare(strict_types=1);

namespace App\ValueObjects\User;

use Webmozart\Assert\Assert;

class Status
{
    private const STATUS_ACTIVE ='STATUS_ACTIVE';
    private const STATUS_PENDING ='STATUS_PENDING';
    private const STATUS_DISABLE ='STATUS_DISABLE';

    private string $name;

    public function __construct(string $name)
    {
        Assert::oneOf($name, [
            self::STATUS_ACTIVE,
            self::STATUS_PENDING,
            self::STATUS_DISABLE,
        ]);
        $this->name = $name;
    }

    public static function active(): self
    {
        return new self(self::STATUS_ACTIVE);
    }

    public static function pending(): self
    {
        return new self(self::STATUS_PENDING);
    }

    public static function disable(): self
    {
        return new self(self::STATUS_DISABLE);
    }

    public function getName(): string
    {
        return $this->name;
    }
}

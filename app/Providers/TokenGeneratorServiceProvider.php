<?php
declare(strict_types=1);

namespace App\Providers;

use App\Utils\Services\TokenGenerator;
use DateInterval;
use Illuminate\Support\ServiceProvider;

class TokenGeneratorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TokenGenerator::class, function ($app): TokenGenerator {
            return new TokenGenerator(new DateInterval(config('token-generator.token_ttl')));
        });
    }
}

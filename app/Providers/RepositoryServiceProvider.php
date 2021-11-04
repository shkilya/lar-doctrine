<?php

namespace App\Providers;

use App\Repositories\RoleRepository;
use App\Repositories\ScientistRepository;
use App\Repositories\UserRepository;
use App\Utils\Repositories\RoleRepositoryInterface;
use App\Utils\Repositories\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register():void
    {
        $this->app->singleton(UserRepositoryInterface::class, fn($app) => $app->make(UserRepository::class));
        $this->app->singleton(RoleRepositoryInterface::class, fn($app) => $app->make(RoleRepository::class));
    }

}

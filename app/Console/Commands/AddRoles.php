<?php

namespace App\Console\Commands;

use App\Entities\Role;
use App\Utils\Repositories\RoleRepositoryInterface;
use App\Utils\UseCases\Role\Command\Create\Command as RoleCreateCommand;
use App\Utils\UseCases\Role\Command\Create\Handler;
use Illuminate\Console\Command;

class AddRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        private Handler                 $handler,
        private RoleRepositoryInterface $roleRepository
    )
    {
        parent::__construct();
    }

    public function handle()
    {
        foreach (Role::ROLE_LIST as $role) {
            if ($this->roleRepository->isRoleExist($role)) {
                continue;
            }
            $this->handler->handle(new RoleCreateCommand($role));
        }
    }
}

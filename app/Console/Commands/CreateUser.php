<?php

namespace App\Console\Commands;

use EntityManager;
use Illuminate\Console\Command;
use App\Entity\User;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create_user {name} {password} {info}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = new User([
            'name' => $this->argument('name'),
            'password' => $this->argument('password'),
            'info' => $this->argument('info')
        ]);

        EntityManager::persist($user);
        EntityManager::flush();

        $this->info('User created');
    }
}

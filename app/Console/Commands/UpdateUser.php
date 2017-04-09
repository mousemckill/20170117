<?php

namespace App\Console\Commands;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Illuminate\Console\Command;
use App\Repository\UserRepo;

class UpdateUser extends Command
{
    /**
     * @var EntityManager
     */
    private $em;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:update_user {name} {info}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update user info';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(EntityManager $em)
    {
        parent::__construct();

        $this->em = $em;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /** @var User $user */
        $user = $this->em->getRepository(User::class)->findOneBy([
            'name' => $this->argument('name')
        ]);

        if ($user === null) {
            $this->error('User not found!');
            return;
        }

        $user->setInfo($this->argument('info'));
        $this->em->persist($user);
        $this->em->flush();
        $this->info('User info updated');
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommandTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateUser()
    {
        Artisan::call('command:create_user', [
            'name' => 'Test',
            'password' => '123456',
            'info' => 'Test Test'
        ]);

        $resultText = Artisan::output();

        $this->assertTrue($resultText == "User created\n");
    }

    public function testUpdateUser()
    {
        $user = entity(\App\Entity\User::class)->create();

        $info = $user->getInfo();

        Artisan::call('command:update_user', [
            'name' => $user->getName(),
            'info' => 'Test Test'
        ]);

        $this->assertTrue($info !== $user->getInfo());
    }

    public function testUserNotFound()
    {
        $user = entity(\App\Entity\User::class)->make();

        Artisan::call('command:update_user', [
            'name' => $user->getName(),
            'info' => 'Test Test'
        ]);

        $resultText = Artisan::output();

        var_dump($resultText);

        $this->assertTrue($resultText == "User not found!\n");
    }
}

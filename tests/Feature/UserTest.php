<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testNotFound()
    {
        $response = $this->get('/api/get-info');

        $response->assertStatus(404);
    }

    public function testSuccess()
    {
        $user = entity(\App\Entity\User::class)->create();

        $name = $user->getName();

        $response = $this->get("/api/get-info/${name}");

        $response->assertJson([
            'info' => $user->getInfo()
        ]);

        $response->assertStatus(200);
    }

    public function testError()
    {
        $user = entity(\App\Entity\User::class)->create();

        $response = $this->get("/api/get-info/1");

        $response->assertJson([
            'error' => 'User not found'
        ]);

        $response->assertStatus(404);
    }
}

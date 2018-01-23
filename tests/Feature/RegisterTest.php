<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserRegistersSuccessfully()
    {
        $response = $this->json('POST', '/api/register', [
            'name' => 'tutu',
            'email' => 'tutu@tutu.com',
            'password' => 'tutu.tutu',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data' => [
                'user',
                // 'token',
                // 'email',
            ],
        ]);
    }

     /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserRegistersWithDuplicateEmail()
    {
        $user = \App\User::create([
            'name' => 'tutu',
            'email' => 'tutu@tutu.com',
            'password' => 'tutu.tutu',
        ]);
        
        $response = $this->json('POST', '/api/register', [
            'name' => 'yoychen',
            'email' => $user->email,
            'password' => 'tutu.123',
        ]);

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'errors' => [
                'email',
            ],
        ]);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;

class UserTest extends TestCase
{
    

    public function setUp(): void
    {
        parent::setUp();
        session()->start();   
    }

    /** @test */
    public function it_can_create_a_user()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password',
            'role' => 'user',
            'status' => 'active',
            'photo' => 'test.jpg',
        ];

        $response = $this->post(route('users.store'), $data);

        $response->assertStatus(302);
         
    }
}


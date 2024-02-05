<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\User;

class LoginTest extends TestCase
{
    // Remove the WithoutMiddleware trait

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserCanLogin()
    {
        // Start a session
        session()->start();

        // Create a new user in the database
        $user = User::create([
            'name' => 'Test User',
            'email' => 'testuser123@example.com',
            'password' => bcrypt('password'),
            'status' => 'active',
            'role' => 'admin'
        ]);

        // Attempt to login with the user's credentials
        $response = $this->post('user/login', [
            'email' => 'testuser123@example.com',
            'password' => 'password',
            '_token' => csrf_token() // Add this
        ]);

        // Assert the user was authenticated
        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    public function testUserCanLogout()
    {
        // Start a session
        session()->start();

        // Create a new user in the database
        $user = User::create([
            'name' => 'Test User',
            'email' => 'testuser1234@example.com',
            'password' => bcrypt('password'),
            'status' => 'active',
            'role' => 'admin'
        ]);

        // Login the user
        $this->be($user);

        // Attempt to logout
        $response = $this->get('user/logout');

        // Assert the user was logged out
        $response->assertRedirect('/');
        $this->assertGuest();
    }

    public function testUserCannotLoginWithIncorrectPassword()
    {
        // Start a session
        session()->start();
    
        // Create a new user in the database
        User::create([
            'name' => 'Test User',
            'email' => 'testuser1239@example.com',
            'password' => bcrypt('password'),
            'status' => 'active',
            'role' => 'admin'
        ]);
    
        // Attempt to login with incorrect password
        $response = $this->post('user/login', [
            'email' => 'testuser1239@example.com',
            'password' => 'wrong-password',
            '_token' => csrf_token() // Add this
        ]);
    
        // Assert the user was not authenticated
        $this->assertGuest();
    }
    
}

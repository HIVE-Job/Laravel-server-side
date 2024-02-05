<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\User;

class CategoryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCategoryCanBeStored()
    {
        // Create a new user in the database
        $user = User::create([
            'name' => 'Test User',
            'email' => 'testuser123@example.com',
            'password' => bcrypt('password'),
            'status' => 'active',
            'role' => 'admin'
        ]);

        // Create a new category
        $category = [
            'title' => 'Test Category',
            'slug' => 'test-category',
            'summary' => 'This is a test category.',
            'photo' => 'test.jpg',
            'status' => 'active',
            'is_parent' => 1,
            'parent_id' => null,
            'added_by' => $user->id
        ];

        // Attempt to store the category
        $response = $this->actingAs($user)->post(route('category.store'), $category);

        // Assert the category was stored
        $response->assertStatus(302);
        $this->assertDatabaseHas('categories', ['title' => 'Test Category']);
    }
}

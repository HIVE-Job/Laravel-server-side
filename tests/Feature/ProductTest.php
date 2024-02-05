<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\User;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testProductCanBeStored()
    {
        // Create a new user in the database
        $user = User::create([
            'name' => 'Test User',
            'email' => 'testuser123@example.com',
            'password' => bcrypt('password'),
            'status' => 'active',
            'role' => 'admin'
        ]);

        // Create a new category in the database
        $category = Category::create([
            'title' => 'Test Category',
            'slug' => 'test-category',
            'status' => 'active',
            'is_parent' => 1,
            'added_by' => $user->id
        ]);

        // Create a new brand in the database
        $brand = Brand::create([
            'title' => 'Test Brand',
            'slug' => 'test-brand',
            'status' => 'active'
        ]);

        // Create a new product
        $product = [
            'title' => 'Test Product',
            'summary' => 'This is a test product.',
            'description' => 'This is a description of the test product.',
            'photo' => 'test.jpg',
            'size' => ['S', 'M', 'L'], // Provide an array here
            'stock' => 10,
            'cat_id' => $category->id,
            'brand_id' => $brand->id,
            'child_cat_id' => null,
            'is_featured' => 1,
            'status' => 'active',
            'condition' => 'new',
            'price' => 100,
            'discount' => 10
        ];

        // Start a session
        session()->start();

        // Attempt to store the product
        $response = $this->actingAs($user)->post(route('product.store'), $product);

        // Assert the product was stored
        $response->assertStatus(302);
        $this->assertDatabaseHas('products', ['title' => 'Test Product']);
    }
}

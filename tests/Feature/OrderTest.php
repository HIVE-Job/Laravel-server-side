<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\Order;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\User;

class OrderTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testOrderCanBeStored()
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

        // Create a new product in the database
        $product = Product::create([
            'title' => 'Test Product',
            'slug' => 'test-product',
            'summary' => 'This is a test product.',
            'description' => 'This is a description of the test product.',
            'photo' => 'test.jpg',
            'size' => 'S,M,L',
            'stock' => 10,
            'cat_id' => $category->id,
            'brand_id' => $brand->id,
            'child_cat_id' => null,
            'is_featured' => 1,
            'status' => 'active',
            'condition' => 'new',
            'price' => 100,
            'discount' => 10
        ]);

        // Create a new order
        $order = [
            'user_id' => $user->id,
            'order_number' => 'ORD-1234567890',
            'sub_total' => 100,
            'quantity' => 1,
            'delivery_charge' => 10,
            'status' => 'new',
            'total_amount' => 110,
            'first_name' => 'Test',
            'last_name' => 'User',
            'country' => 'Test Country',
            'post_code' => '12345',
            'address1' => '123 Test St',
            'address2' => 'Apt 4B',
            'phone' => '1234567890',
            'email' => 'testuser123@example.com',
            'payment_method' => 'cod',
            'payment_status' => 'Unpaid',
            'shipping_id' => 1,
            'coupon' => null
        ];

        // Start a session
        session()->start();

        // Attempt to store the order
        $response = $this->actingAs($user)->post(route('cart.order'), $order);

        // Assert the order was stored
        $response->assertStatus(302);
    }
}


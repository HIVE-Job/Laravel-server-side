<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'title' => $this->faker->randomElement([
                'Elegant Men\'s Leather Wallet',
                'Stylish Men\'s Blue Denim Jeans',
                'Classic White Running Shoes',
                'Men\'s Professional Hair Grooming Kit',
                'Luxury Men\'s Gold Wrist Watch',
                'Men\'s Black Leather Belt',
                'Comfortable Cotton T-Shirt',
                'Men\'s Sports Fitness Tracker',
                'Cool Sunglasses for Men',
                'Men\'s Casual Loafers Shoes'
            ]),
            'slug' => $this->faker->slug,
            'summary' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'cat_id' => 6, 
            'child_cat_id' => 5,  
            'price' => $this->faker->randomNumber(2),
            'brand_id' => 1,  
            'discount' => $this->faker->randomNumber(2),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'photo' => $this->faker->imageUrl,
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'stock' => $this->faker->randomNumber(2),
            'is_featured' => $this->faker->boolean,
            'condition' => $this->faker->randomElement(['default', 'new', 'hot']),
        ];
    }
}


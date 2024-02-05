<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'summary' => $this->faker->paragraph,
            'photo' => $this->faker->imageUrl,
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'is_parent' => $this->faker->boolean,
            'parent_id' => null,  
            'added_by' => $this->faker->randomElement([3, 4]),  
        ];
    }
}


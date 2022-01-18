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
            'title' => $this->faker->title,
            'category_id' => 9,
            'owner_id' => 1,
            'price' => rand(200,5000),
            'discount_percent' => rand(1,70),
            'description' => $this->faker->paragraph,
        ];
    }
}
